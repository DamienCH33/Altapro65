<?php include_once 'header.php'; ?>

<div class="container container-succes d-flex justify-content-center align-items-center" style="min-height: 100vh; background: linear-gradient(135deg, #3d2b1f, #004d00, #007a00, #3d2b1f);">
    <div class="box-succes text-center p-4 rounded">
        <h2>Votre message a bien été envoyé !</h2>
        <p>Vous allez être redirigé automatiquement dans <span id="countdown">4</span> secondes...</p>
    </div>
</div>
<script>
    let seconds = 5;
    const countdownEl = document.getElementById('countdown');

    const countdown = setInterval(() => {
        seconds--;
        countdownEl.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(countdown);
        }
    }, 1000);
</script>

<?php header('Refresh: 5; URL=/index.php'); ?>
<?php include_once 'footer.php'; ?>