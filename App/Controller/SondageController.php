<?php


namespace App\Controller;

use App\Model\SondageModel;

class SondageController
    extends AbstractController
{

    /**
     * SondageController constructor.
     */
    public function __construct()
    {
        parent::__construct(new SondageModel());
    }

    public function renderAdmin()
    {

        if (!$this->auth->islogged() || !$this->auth->isAdmin()) {
            $this->redirectToRoute('home');
            return;
        }
        $msg = null;

        if (!empty($_POST)) {

            if (isset($_POST['poll_submit'])) {
                $title = $_POST['poll_title'];
                $response1 = $_POST['poll_response_1'];
                $response2 = $_POST['poll_response_2'];
                $icon = $_POST['poll_icon'];
                if (!empty($title) && !empty($response1) && !empty($response2) && !empty($icon)) {

                    $id = $this->model->addPoll(
                        $title, $_SESSION['id'], [
                        $response1,
                        $response2,]
                        ,$icon
                    );

                    if ($id === false) {
                        $msg = "Une erreur est survenue, merci de réessayer";
                    }else {
                        $this->redirectToRoute('sondage_result', [
                            'id' => $id
                        ]);
                    }

                } else {
                    $msg = 'Merci de remplir tous les champs.';
                }
            }

        }

        $my_polls = (new SondageModel())->getAllById($_SESSION['id']);

        require $this->render("adminView.php");
    }

    public function renderResponses()
    {

        if (empty($_GET['id']) || !isset($_GET['id']) || !$this->auth->islogged()) {
            $this->redirectToRoute("home");
            return;
        }

        $id_poll = $_GET['id'];

        if($this->model->hasVoted($id_poll, $_SESSION['id'])){
            $this->redirectToRoute(
                "sondage_result", [
                    'id' => $id_poll,
                ]
            );
        }

        $poll = $this->model->getById($id_poll);

        if (empty($poll)) {
            $this->redirectToRoute("home");
            return;
        }

        $responses = [
            0 => $poll[0]['content'],
            1 => $poll[1]['content'],
        ];

        $msg = null;
        if (!empty($_POST)) {

            if (isset($_POST['response_submit'])) {
                if (isset($_POST['response'])) {

                    $response_id = $poll[(int)$_POST['response']][0];
                    $this->model->addVote($response_id);
                    $this->model->setHasVoted($id_poll, $_SESSION['id']);
                    $this->redirectToRoute(
                        "sondage_result", [
                                            'id' => $id_poll,
                                        ]
                    );

                } else {
                    $msg = "Merci de cocher une réponse.";
                }
            }
        }

        require $this->render("sondageView.php");
    }

    public function renderResults()
    {

        if (empty($_GET['id']) || !isset($_GET['id']) || !$this->auth->islogged()) {
            $this->redirectToRoute("home");
            return;
        }

        $id_poll = $_GET['id'];

        $poll = $this->model->getById($id_poll);

        if (empty($poll)) {
            $this->redirectToRoute("home");
            return;
        }

        $tr = (int)$poll[0]['votes'] + (int)$poll[1]['votes'];
        if($tr <= 0) $tr = 1;

        $result = [
            'r1' => [
                'title' => $poll[0]['content'],
                'q'     => $poll[0]['votes'],
                'p'     => round(($poll[0]['votes'] / $tr) * 100, 1),
            ],

            'r2' => [
                'title' => $poll[1]['content'],
                'q'     => $poll[1]['votes'],
                'p'     => round(($poll[1]['votes'] / $tr) * 100, 1),
            ],
        ];

        require $this->render("sondageResultView.php");
    }

    public function getResponses__API__()
    {
        if (!array_key_exists('id', $_GET)) {
            echo '[]';
            return;
        }
        $data = $this->model->getById($_GET['id']);
        $responses = [];
        foreach ($data as $response) {
            $responses[] = '{"id": ' . $response['id'] . ',"votes": ' . $response['votes'] . ',"content": "' . $response['content'] . '"}';
        }
        echo '[' . implode(',', $responses) . ']';
    }
}