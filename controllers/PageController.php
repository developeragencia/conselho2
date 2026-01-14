<?php
/**
 * Controller de Páginas
 */
class PageController {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function home($params = []) {
        $consultants = $this->getConsultants(4);
        include ROOT_PATH . '/views/home.php';
    }
    
    public function consultores($params = []) {
        $consultants = $this->getConsultants();
        $specialties = $this->getSpecialties();
        include ROOT_PATH . '/views/consultores.php';
    }
    
    public function consultorDetalhes($params = []) {
        $slug = $params['slug'] ?? '';
        $consultant = $this->getConsultantBySlug($slug);
        
        if (!$consultant) {
            http_response_code(404);
            include ROOT_PATH . '/views/404.php';
            return;
        }
        
        include ROOT_PATH . '/views/consultor-detalhes.php';
    }
    
    public function blog($params = []) {
        include ROOT_PATH . '/views/blog.php';
    }
    
    public function login($params = []) {
        include ROOT_PATH . '/views/login.php';
    }
    
    public function registro($params = []) {
        include ROOT_PATH . '/views/registro.php';
    }
    
    public function creditos($params = []) {
        include ROOT_PATH . '/views/creditos.php';
    }
    
    public function dashboard($params = []) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        include ROOT_PATH . '/views/dashboard.php';
    }
    
    private function getConsultants($limit = null) {
        $sql = "SELECT * FROM consultants ORDER BY rating DESC, review_count DESC";
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
    
    private function getConsultantBySlug($slug) {
        $stmt = $this->db->prepare("SELECT * FROM consultants WHERE slug = ?");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }
    
    private function getSpecialties() {
        $stmt = $this->db->query("SELECT DISTINCT specialty FROM consultants WHERE specialty IS NOT NULL");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
