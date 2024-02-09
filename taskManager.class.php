<?php 

// Abstract class that defines the methods any task manager should have
abstract class AbstractTaskManager{

    // Method to add a task
    abstract public function addTask(string $task);

    // Method to delete a task
    abstract public function delTask(int $id);

    // Method to retrieve all current tasks
    abstract public function getAllTasks();

}

// Concrete class that implements the methods defined in the abstract class
class TaskManager  {

    // Unique identifier for the task
    protected $_id;

    // Name of the task
    protected $_name;

    // Instance of the database connection
    protected $_dbh;

    // Database object
    private $dataBase;

    // Setter for the database connection instance
    public function setDbh($dbh) {
        $this->_dbh = $dbh;
    }

    // Getter for the database connection instance
    public function getDbh() {
        return $this->_dbh;
    }

    // Constructor where we assign the database connection parameters
    public function __construct() {

        // Create a new database object
        $this->dataBase = new DataBase;
    }

    // Setter for the task id
    public function setId ($id) {
        $this->_id = $id;
    }

    // Getter for the task id
    public function getId() {
        return $this->_id;
    }

    // Setter for the task name
    public function setName($name) {
        $this->_name = $name;
    }

    // Getter for the task name
    public function getName() {
        return $this->_name;
    }

    // Method to add a task
    public function addTask(string $name) {

        // Check if the task name is set
        if(isset($name)){

            // SQL query to add a task
            $ajouterTask = "INSERT INTO mytable (name) VALUES (:name)";
            $stmtA =$this->dataBase->prepare($ajouterTask);
            $stmtA->bindParam(':name', $name, PDO::PARAM_STR);
            $stmtA->execute();

            // Check if the task was added successfully
            if($stmtA->rowCount()>0){
                echo "<script>alert('tache ajoutée')</script>";
            }
        }
    }

    // Method to delete a task
    public function delTask(int $id) {

        // Get the task id from the GET request
        $id = $_GET['del_task'];
        error_log($id);

        // SQL query to delete a task
        $supprimerTask = "DELETE FROM mytable WHERE id=:id";
        $stmts = $this->dataBase->prepare($supprimerTask);
        $stmts->bindParam(':id', $id, PDO::PARAM_INT);
        $stmts->execute();
    }

    // Method to retrieve all tasks
    public function getAllTasks() {

        // SQL query to get all tasks
        $montreTask = "SELECT * FROM mytable";
        $stmtm = $this->dataBase->prepare($montreTask);
        $stmtm->execute();
        $rows = $stmtm->fetchAll();
        
        // Return the tasks
        return $rows;
        
        // Log the tasks
        error_log("getAll : ".print_r($rows, 1));
    } 
    
    
}

?>