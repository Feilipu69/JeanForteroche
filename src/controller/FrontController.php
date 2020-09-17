<?php
namespace Bihin\Forteroche\src\controller;
use Bihin\Forteroche\src\DAO\{
	EpisodeManager,
	CommentManager,
	UserManager
};
use Bihin\Forteroche\utils\View;

class FrontController 
{
	public function home(){
		$episode = new EpisodeManager();
		$episodes = $episode->getEpisodes();

		$myView = new View('home');
		$myView->render(['episodes' => $episodes]);
	}

	public function getChapter($chapter){
		$manager = new EpisodeManager();
		$episodes = $manager->getEpisodes();
		$episode = $manager->getEpisode($chapter); 

		$episodeComments = new CommentManager();
		$comments = $episodeComments->getComments($chapter);

		$myView = new View('episode');
		$myView->render(
			[
				'episode' => $episode,
				'episodes' => $episodes,
				'comments' => $comments
			]
		);
	}

	public function addComment($post, $chapter){
		if (isset($post['submit'])) {
			if (!empty($post['author']) && !empty($post['comment'])) {
				$manager = new CommentManager();
				$comment = $manager->addComment($post, $chapter);
				header('Location:http://' . $_SERVER['HTTP_HOST'] . '/blog/episode/' . $chapter);
			}
		}
	}

	public function rudeComment($id){
		$manager = new CommentManager();
		$rudeComment = $manager->rudeCommentPlus($id);
		$chapter = $manager->getEpisodeIdById($id);
		header('Location:http://' . $_SERVER['HTTP_HOST'] . '/blog/episode/' . $chapter->getEpisodeId());
	}

	public function connection($post){
		if (isset($post['connection'])) {
			if (!empty($post['login']) && !empty($post['password'])) {
				$manager = new UserManager();
				if ($manager->checkPassword($post)) {
					$_SESSION['login'] = $post['login'];
					$roleId = $manager->getUserData();
					$_SESSION['roleId'] = $roleId->getName();
					header('Location:http://' . $_SERVER['HTTP_HOST'] . '/blog');
				} else {
					echo 'Données incorrectes';
				}
			}
		}

		$myView = new View('connection');
		$myView->render([]);
	}

	public function register($post){
		if (isset($post['register'])) {
			if (!empty($post['login']) && !empty($post['password']) && !empty($post['email'])) {
				$manager= new UserManager();
				if ($manager->checkUser($post)) {
					echo 'Ce login existe déjà.';
				}
				else {
					$manager->register($post);
					$_SESSION['login'] = $post['login'];
					$userId = $manager->getUserData();
					$_SESSION['userId'] = $userId->getId();
					header('Location:http://' . $_SERVER['HTTP_HOST'] . '/blog');
				}
			}
		}

		$myView = new View('register');
		$myView->render([]);
	}

	public function updateData($post){
		if (isset($_SESSION['login'])) {
			$manager= new UserManager();
			$userData = $manager->getUserData();
			if (isset($post['updateData'])) {
				if (!empty($post['login']) && !empty($post['password']) && !empty($post['email'])) {
					if ($manager->checkUser($post)) {
						echo 'Ce login existe déjà.';
					}
					else {
						$manager->updateData($post);
						$_SESSION['login'] = $post['login'];
						header('Location:http://' . $_SERVER['HTTP_HOST'] . '/blog');
					}
				}
			}

			$myView = new View('updateData');
			$myView->render([
				'userData' => $userData
			]);
		} else {
			header('Location:http://' . $_SERVER['HTTP_HOST'] . '/blog');
		}
	}

	public function disconnection(){
		if (isset($_SESSION['login'])) {
			unset($_SESSION['login']);
			session_destroy();
			header('Location:http://' . $_SERVER['HTTP_HOST'] . '/blog');
		}
	}

	public function deleteCount($login){
		$manager = new UserManager();
		$manager->deleteCount($login);
		unset($_SESSION['login'], $_SESSION['userId']);
		header('Location:http://' . $_SERVER['HTTP_HOST'] . '/blog');
	}
}
