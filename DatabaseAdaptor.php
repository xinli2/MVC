<?php
// Xin Li
class DatabaseAdaptor
{
    private $DB; // The instance variable used in every method
    // Connect to an existing data based named 'first'
    public function __construct()
    {
        $dataBase = 'mysql:dbname=imdb_small;charset=utf8;host=127.0.0.1';
        $user = 'root';
        $password = ''; // Use the empty string with our XAMPP install
        try {
            $this->DB = new PDO($dataBase, $user, $password);
            $this->DB->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            echo ('Error establishing Connection');
            exit();
        }
    } // . . . continued

    public function getAllMovies($name)
    {
        $stmt = $this->DB->prepare("SELECT name FROM movies WHERE name LIKE '%" . trim($name) . "%';");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllActors($name)
    {
        $stmt = $this->DB->prepare("SELECT first_name, last_name FROM actors WHERE first_name LIKE '%" . trim($name) . "%' OR last_name LIKE '%" . trim($name) . "%';");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRoles($name)
    {
        $stmt = $this->DB->prepare("SELECT role FROM roles WHERE role LIKE '%" . trim($name) . "%';");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRolesMovies($name)
    {
        list($first, $last) = explode(' ', $name);
        $stmt = $this->DB->prepare("SELECT name, role FROM actors JOIN roles ON actors.id = roles.actor_id JOIN movies ON roles.movie_id = movies.id WHERE first_name='" . $first . "' AND last_name='" . $last . "'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}// End class DatabaseAdaptor
//$theDBA = new DatabaseAdaptor();
//print_r($theDBA->getMoviesReleasedSince(2004));
