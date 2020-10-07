<?php
class Querys extends Database{
	//some variables that are used when storing data in the database
	private $code;
    private $name;
	private $prog;
	private $syllabus;
	//strips tags from the input and sets the class-variables equal the them.
	function setPost($code, $name, $prog, $syllabus){
		$this->code = strip_tags($code);
		$this->name = strip_tags($name);
		$this->prog = strip_tags($prog);
		$this->syllabus = strip_tags($syllabus);

        if($this->code != "" ){
            return true;
        } else { 
            return false;
        }
	}
	//checks if the code that was sent is already in the database, since it is used as primar key in the sql
	function checkCode($inId){
		$stmnt = $this->connect()->prepare("SELECT * FROM Post WHERE code=?");
		$stmnt->execute([$inId]);
        $count = $stmnt->fetch();
        if($count){
			return true;
        }else{
			return false;
        }
	}
	//fetches every row in the table Post
	function getit(){
		$stmnt = $this->connect()->prepare("SELECT * FROM Post");
		$stmnt->execute();
		return $stmnt->fetchAll(PDO::FETCH_ASSOC);
	}

	//adds a row to the table Post, after using checkCode and setPost.
	function addCourse($incode, $inname, $inprog, $insyllabus){
		if(!$this->checkCode($incode)){
			$stmnt = $this->connect()->prepare("INSERT INTO Post (code, name, prog, syllabus) VALUES (?, ?, ?, ?)");
			if($this->setPost($incode, $inname, $inprog, $insyllabus)){
				if($stmnt->execute([$this->code, $this->name, $this->prog, $this->syllabus])){
					return true;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}

	//deletes a row from the table with the specified code
	function deleteCourse($incode){
		$stmnt = $this->connect()->prepare("DELETE FROM Post WHERE code=?");
		if($stmnt->execute([$incode])){
			return true;
		} else {
			return false;
		}
	}

		//updates a row in the table with the specified code and sets the new data to the data that was sent.
	function updateCourse($incode, $inname, $inprog, $insyllabus){
		$stmnt = $this->connect()->prepare("UPDATE Post SET name=?, prog=?, syllabus=? WHERE code=?");
		if($this->setPost($incode, $inname, $inprog, $insyllabus)){
		if($stmnt->execute([$this->name, $this->prog, $this->syllabus, $this->code])){
			return true;
		} else {
			return false;
		}
		$stmnt->execute([]);
		}
	}
}