<?php
/**
 * Controller de API
 */
class ApiController {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');
    }
    
    public function getConsultants($params = []) {
        $specialty = $_GET['specialty'] ?? null;
        $limit = $_GET['limit'] ?? null;
        
        $sql = "SELECT * FROM consultants WHERE 1=1";
        $params_arr = [];
        
        if ($specialty) {
            $sql .= " AND specialty = ?";
            $params_arr[] = $specialty;
        }
        
        $sql .= " ORDER BY rating DESC, review_count DESC";
        
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params_arr);
        $consultants = $stmt->fetchAll();
        
        echo json_encode($consultants);
    }
    
    public function getConsultantsFeatured($params = []) {
        $this->getConsultants();
    }
    
    public function getConsultantBySlug($params = []) {
        $slug = $params['slug'] ?? '';
        $stmt = $this->db->prepare("SELECT * FROM consultants WHERE slug = ?");
        $stmt->execute([$slug]);
        $consultant = $stmt->fetch();
        
        if ($consultant) {
            echo json_encode($consultant);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Consultor não encontrado']);
        }
    }
    
    public function login($params = []) {
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            echo json_encode([
                'success' => true,
                'user' => [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'firstName' => $user['first_name'],
                    'role' => $user['role']
                ]
            ]);
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'Email ou senha incorretos']);
        }
    }
    
    public function register($params = []) {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $email = $data['email'] ?? '';
        $name = $data['name'] ?? '';
        $password = $data['password'] ?? '';
        $role = $data['role'] ?? 'cliente';
        $cpf = $data['cpf'] ?? '';
        $phone = $data['phone'] ?? '';
        
        if (!$email || !$name || !$password) {
            http_response_code(400);
            echo json_encode(['error' => 'Campos obrigatórios faltando']);
            return;
        }
        
        $id = 'user_' . time() . '_' . bin2hex(random_bytes(4));
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $nameParts = explode(' ', $name, 2);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? '';
        $credits = $role === 'cliente' ? 10.00 : 0.00;
        
        try {
            $stmt = $this->db->prepare("INSERT INTO users (id, email, first_name, last_name, password_hash, role, phone, cpf, credits) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$id, $email, $firstName, $lastName, $passwordHash, $role, $phone, $cpf, $credits]);
            
            echo json_encode([
                'success' => true,
                'message' => ucfirst($role) . ' registrado com sucesso!',
                'user' => ['id' => $id, 'email' => $email, 'firstName' => $firstName, 'role' => $role]
            ]);
        } catch (PDOException $e) {
            http_response_code(400);
            echo json_encode(['error' => 'Email já cadastrado']);
        }
    }
}
