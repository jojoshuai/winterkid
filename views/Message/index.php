        <div class="container" style="color: #fff; text-align: center; box-shadow: inset 0 0 100px rgba(0,0,0,.5) text-align: center">
            messages: <br>
            <?php
            foreach ($this->messages as $message) {
                echo $message->getUserName() . ' | ' . $message->getContent() . ' | ' . $message->getPublishDate() . '<br>';
            }
            ?>
        </div>
