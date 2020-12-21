<?php

namespace App\Model;

use Core\Database;
use DateTime;

class SondageModel
    extends Database
{

    public function getAll(): array
    {
        return $this->query(
            'SELECT *
FROM `polls` 
INNER JOIN `users` on `polls`.`author_id` = `users`.`id`'
        );
    }

    public function getAllById(string $id): array
    {
        return $this->prepare(
            'SELECT *
FROM polls 
INNER JOIN users on polls.author_id = users.id
WHERE polls.author_id = :id',
            ['id' => $id]
        );
    }

    public function getById(int $id): array
    {
        return $this->prepare(
            'SELECT *
FROM poll_responses
         INNER JOIN polls on poll_responses.poll_id = polls.id
         INNER JOIN users on polls.author_id = users.id
WHERE polls.id = :id', ['id' => $id]
        );
    }

    public function getLatest(int $count): array
    {
        return $this->prepare(
            'SELECT *
FROM polls
         INNER JOIN users on polls.author_id = users.id
LIMIT :maxPolls',
            [':maxPolls' => $count]
        );
    }

    public function addPoll(string $title, int $authorId, array $responses, string $icon)
    {
        $id = $this->prepare(
            'INSERT INTO polls(title, author_id, icon, hasvoted) VALUES (:title,:authorId,:icon,:hasvoted) RETURNING id',
            [
                ':title'    => $title,
                ':authorId' => $authorId,
                ':icon' => $icon,
                ':hasvoted' => "",
            ], true
        );
        if ($id === false) {
            return false;
        }
        $id = $id['id'];
        $query = 'INSERT INTO `poll_responses`(`poll_id`,`content`,`votes`) VALUES ';
        $queryFragment = '';
        for ($i = 0, $iMax = count($responses); $i < $iMax; $i++) {
            $queryFragment .= ",($id,?,0)";
        }
        $query .= substr($queryFragment, 1);
        $this->prepare($query, $responses);
        return $id;
    }

    public function addVote(int $responseId)
    {
        $this->prepare('UPDATE poll_responses SET votes = votes + 1 WHERE id=:id', ['id' => $responseId]);
    }

    public function getHasVoted(int $poll_id){
        $hasvoted = $this->prepare('SELECT hasvoted FROM polls WHERE id=:id', [
            ':id' => $poll_id,
        ], true)[0];

        $hasvoted = explode("/", $hasvoted);
        if($hasvoted === null) return [];
        else return $hasvoted;
    }

    public function hasVoted(int $poll_id, $user_id){
        return in_array((String)$user_id, $this->getHasVoted($poll_id), true);
    }

    public function setHasVoted(int $poll_id, int $user_id)
    {
        $hasvotes = $this->getHasVoted($poll_id);
        $hasvotes[] = $user_id;
        $list = "";
        foreach($hasvotes as $id) {
            $list.="/$id";
        }
        $this->prepare('UPDATE polls SET hasvoted=:list WHERE id=:poll_id', [
            ':poll_id' => $poll_id,
            ':list' => $list]);
    }
}