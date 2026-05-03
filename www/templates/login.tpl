<?php $this->layout('home', ['title' => 'Login']) ?>

<article>
    <header>
        <h1>Login</h1>
    </header>

    <?php if (isset($login_fallito)):?>
        <p><strong>Credenziali non corrette, riprova.</strong></p>
    <?php endif; ?>

    <form action="/auth" method="post">
        <label for="username">
            Username
            <input type="text" id="username" placeholder="Username" name="username" required>
        </label>

        <label for="password">
            Password
            <input type="password" id="password" placeholder="Password" name="password" required>
        </label>

        <button type="submit">Invia credenziali</button>
    </form>
</article>
