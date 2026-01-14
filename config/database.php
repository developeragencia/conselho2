<?php
/**
 * Configuração do Banco de Dados
 */
class Database {
    private static $instance = null;
    private $conn;
    
    private function __construct() {
        $host = getenv('DB_HOST') ?: 'localhost';
        $dbname = getenv('DB_NAME') ?: 'conselhos_esotericos';
        $username = getenv('DB_USER') ?: 'root';
        $password = getenv('DB_PASS') ?: '';
        
        try {
            $this->conn = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
            
            // Criar tabelas automaticamente
            $this->createTables();
        } catch (PDOException $e) {
            // Se não conseguir conectar, usar SQLite como fallback
            $this->conn = new PDO('sqlite:' . ROOT_PATH . '/database.sqlite');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTables();
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
    
    private function createTables() {
        $tables = [
            "CREATE TABLE IF NOT EXISTS users (
                id VARCHAR(50) PRIMARY KEY,
                email VARCHAR(255) UNIQUE NOT NULL,
                first_name VARCHAR(100) NOT NULL,
                last_name VARCHAR(100) NOT NULL,
                password_hash VARCHAR(255) NOT NULL,
                role VARCHAR(20) DEFAULT 'cliente',
                phone VARCHAR(20),
                cpf VARCHAR(20),
                credits DECIMAL(10,2) DEFAULT 10.00,
                is_active BOOLEAN DEFAULT 1,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
            
            "CREATE TABLE IF NOT EXISTS consultants (
                id VARCHAR(50) PRIMARY KEY,
                slug VARCHAR(255) UNIQUE NOT NULL,
                name VARCHAR(255) NOT NULL,
                title VARCHAR(255),
                specialty VARCHAR(100),
                description TEXT,
                price_per_minute DECIMAL(10,2) NOT NULL,
                rating DECIMAL(3,2) DEFAULT 0.00,
                review_count INT DEFAULT 0,
                status VARCHAR(20) DEFAULT 'offline',
                image_url VARCHAR(500),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )"
        ];
        
        foreach ($tables as $sql) {
            try {
                $this->conn->exec($sql);
            } catch (PDOException $e) {
                // Ignorar se tabela já existe
            }
        }
        
        // Inserir dados mock de consultores se não existirem
        $this->seedConsultants();
    }
    
    private function seedConsultants() {
        $stmt = $this->conn->query("SELECT COUNT(*) as count FROM consultants");
        $result = $stmt->fetch();
        
        if ($result['count'] == 0) {
            $consultants = [
                ['1', 'maria-fernanda-tarot', 'Maria Fernanda', 'Taróloga Profissional', 'Tarot', 'Especialista em tarot há mais de 10 anos', 3.50, 4.9, 127, 'online', '/images/consultants/maria-fernanda.jpg'],
                ['2', 'joao-carlos-astrologia', 'João Carlos', 'Astrólogo Certificado', 'Astrologia', 'Astrólogo com mais de 15 anos de experiência', 4.00, 4.8, 89, 'online', '/images/consultants/joao-carlos.jpg'],
                ['3', 'ana-silva-numerologia', 'Ana Silva', 'Numeróloga', 'Numerologia', 'Especialista em numerologia', 3.00, 4.7, 95, 'busy', '/images/consultants/ana-silva.jpg'],
                ['4', 'carlos-mendes-runas', 'Carlos Mendes', 'Mestre em Runas', 'Runas', 'Especialista em leitura de runas', 3.75, 4.9, 112, 'online', '/images/consultants/carlos-mendes.jpg']
            ];
            
            $stmt = $this->conn->prepare("INSERT INTO consultants (id, slug, name, title, specialty, description, price_per_minute, rating, review_count, status, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            foreach ($consultants as $c) {
                try {
                    $stmt->execute($c);
                } catch (PDOException $e) {
                    // Ignorar duplicatas
                }
            }
        }
    }
}
