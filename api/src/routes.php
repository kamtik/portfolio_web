<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', function ($request, $response, $args) {
    $this->logger->info("index '/' route");
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/movies', function ($request, $response, $args) {
	$this->logger->info("index '/' route");
    $stmt = $this->db->prepare("select a.id id, a.name name, a.description description ,a.img img, CAST(ifnull(avg(b.rating)+0,-1) as dec(3,1)) rate ,count(b.id) cnt from movie a LEFT JOIN feedback b on a.id=b.movie_id group by a.id,a.name,a.description,a.img order by a.id desc");
    $stmt->execute();
    $movies = $stmt->fetchAll();
	return $this->response->withJson($movies);    	
});


$app->get('/movie/{id}', function ($request, $response, $args) {
    $stmt = $this->db->prepare("select a.id id, a.name name, a.description description ,a.img img, CAST(ifnull(avg(b.rating)+0,-1) as dec(3,1)) rate ,count(b.id) cnt from movie a LEFT JOIN feedback b on a.id=b.movie_id where a.id=:id group by a.id,a.name,a.description,a.img order by a.id desc");
	$stmt->bindParam("id", $args['id']);
    $stmt->execute();
    $movie = $stmt->fetchObject();
	return $this->response->withJson($movie);    
});

$app->get('/feedbacks/{id}', function ($request, $response, $args) {
    $stmt = $this->db->prepare("select id, name, rating rate, comment from feedback where movie_id=:id order by created desc");
	$stmt->bindParam("id", $args['id']);
    $stmt->execute();
    $fb = $stmt->fetchAll();
	return $this->response->withJson($fb);    
});

 $app->post('/feedback/insert', function ($request, $response) {
	$fb = $request->getParsedBody();
	$sql = "INSERT INTO feedback (movie_id, name, rating, comment) VALUES (:movie_id, :name, :rating, :comment)";
	$stmt = $this->db->prepare($sql);
	$stmt->bindParam("movie_id", $fb["movie_id"]);
	$stmt->bindParam("name", $fb["name"]);
    $stmt->bindParam("rating", $fb["rating"]);
	$stmt->bindParam("comment", $fb["comment"]);
	$stmt->execute();
	$fb["id"] = $this->db->lastInsertId();
	return $this->response->withJson($fb);
});

$app->put('/movie/update/{id}', function ($request, $response, $args) {
	$movie = $request->getParsedBody();
	$sql = "UPDATE movie SET description=:description WHERE id=:id";
	$stmt = $this->db->prepare($sql);
	$stmt->bindParam("description", $movie["description"]);
	$stmt->bindParam("id", $args['id']);
	$stmt->execute();
	// $movie["id"] = $args['id'];
	return $this->response->withJson($movie);
});

$app->delete('/feedback/delete/{id}', function ($request, $response, $args) {
	$stmt = $this->db->prepare("DELETE FROM feedback WHERE id=:id");
	$stmt->bindParam("id", $args['id']);
	$stmt->execute();
	$fb = $stmt->fetchAll();
	return $this->response->withJson($fb);
});
