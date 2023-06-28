<?php

declare(strict_types=1);

class PostController extends Controller
{
    private Post $model;
    private CSRFService $csrfService;
    private MailService $mailService;
    private SMSService $smsService;

    public function __construct()
    {
        $this->model = $this->model('Post');
        $this->mailService = new MailService();
        $this->csrfService = new CSRFService();
        $this->smsService = new SMSService();
    }

    public function index(): void
    {
        $this->view('layout', [
            'posts' => $this->model->getPosts(),
            'contentOfView' => 'post/index.php',
            'csrfToken' => $this->csrfService->createToken(),
        ]);
    }

    public function store(): void
    {
        if (
            isset($_POST['csrfToken'])
            && $this->csrfService->validateToken($_POST['csrfToken'])
            && isset($_POST['postText'])
            && !empty($_POST['postText'])
            && is_string($_POST['postText'])
        ) {
            try {
                $postText = $this->processInputData($_POST['postText']);
                $this->model->addNewPost($postText);
                $this->mailService->sendMail('New Post!!!', $postText);
                $this->smsService->sendSMS('New Post!!!');

                echo json_encode(["success" => true, "message" => "New post was added"]);
            } catch (Exception $e) {
                echo json_encode(["success" => false, "message" => "Can't processed a new post"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Not valid input data"]);
        }
    }
}
