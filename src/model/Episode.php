<?php
namespace Bihin\Forteroche\src\model;

class Episode
{
	private $id;
	private $chapter;
	private $title;
	private $content;
	private $creationDate;
	private $updateDate;
	private $userId;

	public function __construct(array $data){
		$this->hydrate($data);
	}

	public function hydrate(array $data){
		foreach ($data as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function getId(){
		return $this->id;
	}

	public function getChapter(){
		return $this->chapter;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getContent(){
		return $this->content;
	}

	public function getCreationDate(){
		return $this->creationDate;
	}

	public function getUpdateDate(){
		return $this->updateDate;
	}

	public function getUserId(){
		return $this->userId;
	}

	public function setId(int $id){
		if ($id > 0) {
			$this->id = $id;
		}
	}

	public function setChapter(int $chapter){
		if ($chapter > 0) {
			$this->chapter = $chapter;
		}
	}

	public function setTitle(string $title){
		$this->title = $title;
	}

	public function setContent(string $content){
		$this->content = $content;
	}

	public function setCreationDate($creationDate){
		$this->creationDate = $creationDate;
	}

	public function setUpdateDate($updateDate){
		$this->updateDate = $updateDate;
	}

	public function setUserId(int $userId){
		if ($userId > 0) {
			$this->userId = $userId;
		}
	}
}
