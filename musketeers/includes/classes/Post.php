<?php
class Post {
	private $user_obj;
	private $con;

	public function __contruct($con, $user) {
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}

	public function submitPost($body, $user_to) {
		$body = strip_tags($body); //remove html tags
		$body = mysqli_escape_string($this->con, $body);
		$check_empty = preg_replace('/\s+/', '', $body); //delete all spaces

		if ($check_empty != "") {
			//current date and time
			$date_added = date("Y-m-d H:i:s");

			//Get username
			$added_by = $this->user_obj->getUsername();

			//If user is not on profile, user_to is 'none'
			if ($user_to == $user_added) {
				$user_to = "none";
			}

			//insert post
			$query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0')");
			$return_id = mysqli_insert_id($this->con);

			//insert notification

			//upadate post count for user
			$num_posts = $this->user_obj->getNumPost();
			$num_posts++;
			$update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");
		}
	}
}
?>