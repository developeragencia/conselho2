#!/usr/bin/env node

/**
 * CONSELHOS ESOTÉRICOS - SERVIDOR FINAL
 * Sistema completamente independente sem migrações
 */

import express from 'express';
import path from 'path';
import { fileURLToPath } from 'url';
import { existsSync } from 'fs';
import { Pool } from '@neondatabase/serverless';
import bcrypt from 'bcrypt';
import jwt from 'jsonwebtoken';
import crypto from 'crypto';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const app = express();
const PORT = process.env.PORT || 5000;
const JWT_SECRET = process.env.JWT_SECRET || 'conselhos_secret_2025';

// Middleware
app.use(express.json());
app.use((req, res, next) => {
  res.header('Access-Control-Allow-Origin', '*');
  res.header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
  res.header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
  if (req.method === 'OPTIONS') {
    return res.sendStatus(200);
  }
  next();
});
// Servir arquivos estáticos
const staticPath = path.join(__dirname, 'dist', 'public');
if (existsSync(staticPath)) {
  app.use(express.static(staticPath));
} else {
  // Fallback para public se dist não existir
  app.use(express.static(path.join(__dirname, 'public')));
}

// Storage híbrido
let db;
const memory = { users: new Map(), sessions: new Map(), consultants: new Map() };

// Dados mock de consultores
const mockConsultants = [
  {
    id: '1',
    slug: 'maria-fernanda-tarot',
    name: 'Maria Fernanda',
    title: 'Taróloga Profissional',
    specialty: 'Tarot',
    description: 'Especialista em tarot há mais de 10 anos, com foco em relacionamentos e carreira.',
    price_per_minute: 3.50,
    rating: 4.9,
    review_count: 127,
    status: 'online',
    image_url: '/images/consultants/maria-fernanda.jpg'
  },
  {
    id: '2',
    slug: 'joao-carlos-astrologia',
    name: 'João Carlos',
    title: 'Astrólogo Certificado',
    specialty: 'Astrologia',
    description: 'Astrólogo com mais de 15 anos de experiência em mapas astrais e previsões.',
    price_per_minute: 4.00,
    rating: 4.8,
    review_count: 89,
    status: 'online',
    image_url: '/images/consultants/joao-carlos.jpg'
  },
  {
    id: '3',
    slug: 'ana-silva-numerologia',
    name: 'Ana Silva',
    title: 'Numeróloga',
    specialty: 'Numerologia',
    description: 'Especialista em numerologia e análise de personalidade através dos números.',
    price_per_minute: 3.00,
    rating: 4.7,
    review_count: 95,
    status: 'busy',
    image_url: '/images/consultants/ana-silva.jpg'
  },
  {
    id: '4',
    slug: 'carlos-mendes-runas',
    name: 'Carlos Mendes',
    title: 'Mestre em Runas',
    specialty: 'Runas',
    description: 'Especialista em leitura de runas nórdicas e orientação espiritual.',
    price_per_minute: 3.75,
    rating: 4.9,
    review_count: 112,
    status: 'online',
    image_url: '/images/consultants/carlos-mendes.jpg'
  }
];

// Inicializar banco SEM migrações
const initDB = async () => {
  try {
    if (process.env.DATABASE_URL) {
      db = new Pool({ connectionString: process.env.DATABASE_URL });
      
      await db.query(`
        CREATE TABLE IF NOT EXISTS users (
          id TEXT PRIMARY KEY,
          email TEXT UNIQUE NOT NULL,
          first_name TEXT NOT NULL,
          last_name TEXT NOT NULL,
          password_hash TEXT NOT NULL,
          role TEXT NOT NULL DEFAULT 'cliente',
          phone TEXT,
          cpf TEXT,
          credits DECIMAL(10,2) DEFAULT 10.00,
          is_active BOOLEAN DEFAULT true,
          created_at TIMESTAMP DEFAULT NOW()
        );
      `);
      
      await db.query(`
        CREATE TABLE IF NOT EXISTS consultants (
          id TEXT PRIMARY KEY,
          slug TEXT UNIQUE NOT NULL,
          name TEXT NOT NULL,
          title TEXT,
          specialty TEXT,
          description TEXT,
          price_per_minute DECIMAL(10,2) NOT NULL,
          rating DECIMAL(3,2) DEFAULT 0.00,
          review_count INTEGER DEFAULT 0,
          status TEXT DEFAULT 'offline',
          image_url TEXT,
          created_at TIMESTAMP DEFAULT NOW()
        );
      `);
      
      // Inserir consultores mock se a tabela estiver vazia
      const countResult = await db.query('SELECT COUNT(*) as count FROM consultants');
      if (parseInt(countResult.rows[0].count) === 0) {
        for (const consultant of mockConsultants) {
          await db.query(`
            INSERT INTO consultants (id, slug, name, title, specialty, description, price_per_minute, rating, review_count, status, image_url)
            VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)
          `, [
            consultant.id,
            consultant.slug,
            consultant.name,
            consultant.title,
            consultant.specialty,
            consultant.description,
            consultant.price_per_minute,
            consultant.rating,
            consultant.review_count,
            consultant.status,
            consultant.image_url
          ]);
        }
        console.log('Consultores mock inseridos no banco');
      }
      
      console.log('Database conectado');
      return true;
    }
  } catch (e) {
    console.log('Usando memória');
  }
  return false;
};

// Funções de usuário
const createUser = async (data) => {
  const id = `user_${Date.now()}_${Math.random().toString(36).substr(2, 9)}`;
  const hash = await bcrypt.hash(data.password, 10);
  
  const user = {
    id,
    email: data.email.toLowerCase(),
    first_name: data.name.split(' ')[0],
    last_name: data.name.split(' ').slice(1).join(' ') || '',
    password_hash: hash,
    role: data.role,
    phone: data.phone,
    cpf: data.cpf,
    credits: data.role === 'cliente' ? '10.00' : '0.00',
    is_active: true,
    created_at: new Date()
  };

  if (db) {
    try {
      await db.query(`
        INSERT INTO users VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)
      `, [user.id, user.email, user.first_name, user.last_name, user.password_hash, 
          user.role, user.phone, user.cpf, user.credits, user.is_active, user.created_at]);
    } catch (e) {
      memory.users.set(user.email, user);
    }
  } else {
    memory.users.set(user.email, user);
  }
  
  return user;
};

const findUser = async (email) => {
  if (db) {
    try {
      const result = await db.query('SELECT * FROM users WHERE email = $1', [email]);
      return result.rows[0];
    } catch (e) {}
  }
  return memory.users.get(email);
};

// Função para buscar consultores
const getConsultants = async (limit = null) => {
  if (db) {
    try {
      let query = 'SELECT * FROM consultants ORDER BY rating DESC, review_count DESC';
      if (limit) {
        query += ` LIMIT ${limit}`;
      }
      const result = await db.query(query);
      return result.rows;
    } catch (e) {
      console.error('Erro ao buscar consultores do banco:', e);
      return mockConsultants.slice(0, limit || mockConsultants.length);
    }
  }
  return mockConsultants.slice(0, limit || mockConsultants.length);
};

// Rotas
app.post('/api/test/register', async (req, res) => {
  try {
    const { email, name, password, role, cpf, phone } = req.body;

    if (!email || !name || !password || !role || !cpf || !phone) {
      return res.status(400).json({ 
        error: 'Campos obrigatórios: email, password, name, role, cpf, phone' 
      });
    }

    if (await findUser(email.toLowerCase())) {
      return res.status(400).json({ error: 'Email já cadastrado' });
    }

    const user = await createUser({ email, name, password, role, cpf, phone });
    const token = jwt.sign({ userId: user.id, role: user.role }, JWT_SECRET, { expiresIn: '7d' });

    res.json({
      success: true,
      token,
      user: { id: user.id, email: user.email, firstName: user.first_name, role: user.role },
      message: `${role.charAt(0).toUpperCase() + role.slice(1)} registrado com sucesso!`
    });
  } catch (error) {
    res.status(500).json({ error: 'Erro interno' });
  }
});

app.post('/api/auth/login', async (req, res) => {
  try {
    const { email, password } = req.body;

    if (!email || !password) {
      return res.status(400).json({ error: 'Email e senha obrigatórios' });
    }

    const user = await findUser(email.toLowerCase());
    if (!user || !user.is_active) {
      return res.status(401).json({ error: 'Email ou senha incorretos' });
    }

    if (!(await bcrypt.compare(password, user.password_hash))) {
      return res.status(401).json({ error: 'Email ou senha incorretos' });
    }

    const token = jwt.sign({ userId: user.id, role: user.role }, JWT_SECRET, { expiresIn: '7d' });

    res.json({
      success: true,
      message: 'Login realizado com sucesso',
      user: {
        id: user.id,
        firstName: user.first_name,
        lastName: user.last_name,
        email: user.email,
        role: user.role,
        credits: user.credits
      },
      token
    });
  } catch (error) {
    res.status(500).json({ error: 'Erro interno' });
  }
});

// Rota para buscar consultores
app.get('/api/consultants', async (req, res) => {
  try {
    const { specialty, limit } = req.query;
    let consultants = await getConsultants();
    
    // Filtrar por especialidade se fornecido
    if (specialty) {
      consultants = consultants.filter(c => 
        c.specialty?.toLowerCase() === specialty.toLowerCase()
      );
    }
    
    // Limitar resultados se fornecido
    if (limit) {
      consultants = consultants.slice(0, parseInt(limit));
    }
    
    res.json(consultants);
  } catch (error) {
    console.error('Erro ao buscar consultores:', error);
    res.status(500).json({ error: 'Erro ao buscar consultores' });
  }
});

// Rota para buscar consultor por slug
app.get('/api/consultants/:slug', async (req, res) => {
  try {
    const { slug } = req.params;
    
    if (db) {
      const result = await db.query('SELECT * FROM consultants WHERE slug = $1', [slug]);
      if (result.rows.length > 0) {
        return res.json(result.rows[0]);
      }
    }
    
    // Fallback para dados mock
    const consultant = mockConsultants.find(c => c.slug === slug);
    if (consultant) {
      return res.json(consultant);
    }
    
    res.status(404).json({ error: 'Consultor não encontrado' });
  } catch (error) {
    console.error('Erro ao buscar consultor:', error);
    res.status(500).json({ error: 'Erro ao buscar consultor' });
  }
});

// Frontend - SPA fallback (deve ser a última rota)
app.get('*', (req, res, next) => {
  // Ignorar requisições de API
  if (req.path.startsWith('/api/')) {
    return res.status(404).json({ error: 'Not found' });
  }
  
  // Tentar dist/public primeiro
  let indexPath = path.join(__dirname, 'dist/public/index.html');
  if (!existsSync(indexPath)) {
    // Fallback para public
    indexPath = path.join(__dirname, 'public/index.html');
  }
  
  if (existsSync(indexPath)) {
    res.sendFile(indexPath);
  } else {
    res.status(404).send('Página não encontrada. Execute "npm run build" primeiro.');
  }
});

// Start
const startServer = async () => {
  try {
    await initDB();
    app.listen(PORT, '0.0.0.0', () => {
      console.log(`✅ Conselhos Esotéricos rodando na porta ${PORT}`);
      console.log(`📁 Servindo arquivos de: ${existsSync(path.join(__dirname, 'dist/public')) ? 'dist/public' : 'public'}`);
    });
  } catch (error) {
    console.error('❌ Erro ao iniciar servidor:', error);
    process.exit(1);
  }
};

startServer();