<?php include_once 'header.php'; ?>

<div class="container-succes">
    <div class="box-succes">
        <h2>Votre message a bien été envoyé !</h2>
        <p>Vous allez être redirigé automatiquement dans <span id="countdown">4</span> secondes...</p>
    </div>
</div>

<script>
    let seconds = 4;
    const countdownEl = document.getElementById('countdown');

    const countdown = setInterval(() => {
        seconds--;
        countdownEl.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(countdown);
        }
    }, 1000);
</script>

<?php header('Refresh: 4; URL=/index.php'); ?>
<?php include_once 'footer.php'; ?>