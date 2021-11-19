  <?php 
  
  require '../src/Validator.php';

  $val = new Validator; ?>

  <form method="post" action="#">
      <label for="name">Name:</label>
      <input type="text" name="name" pattern="<?php echo $val->patterns['words']; ?>" required>
      <label for="email">E-Mail:</label>
      <input type="email" name="email" required>
      <label for="tel">Telephone:</label>
      <input type="text" name="tel" pattern="<?php echo $val->patterns['tel']; ?>">
      <label for="message">Message:</label>
      <textarea name="message" cols="40" rows="6" required></textarea>
      <button type="submit">Send</button>
  </form>

  <?php

    if (!empty($_POST)) {

        $val->name('name')->value($_POST['name'])->pattern('words')->required();
        $val->name('e-mail')->value($_POST['email'])->pattern('email')->required();
        $val->name('tel')->value($_POST['tel'])->pattern('tel');
        $val->name('message')->value($_POST['message'])->pattern('text')->required();

        if ($val->isSuccess()) {
            echo 'Validation ok!';
        } else {
            echo $val->displayErrors();
        }
    }

    ?>