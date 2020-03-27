
<?php

class oopsController extends Controller
{
    protected $OopsMessage = "404";
    public function oopsNotFound($message)
    {
        $this -> OopsMessage = $message;
        $this -> view("oops/Errorpage", $this -> OopsMessage);
        $this -> view -> render();
    }

    public function unknownError()
    {
        $this -> OopsMessage = "";
        $this -> view("oops/UnknownErrorpage");
        $this -> view -> render();
    }
}

?>