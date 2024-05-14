 <!--Show Cookie Alert Only When User Isn't Authenticated-->
<?php if (!isset($_SESSION["id"])):?>
    <div class="alert text-center cookiealert" role="alert">
        <b>Cookies Alert</b> &#x1F36A; When you choose to be remembered, cookies are used to keep track of your user session <a href="https://cookiesandyou.com/" target="_blank">Learn more about cookies</a>

        <button type="button" class="btn btn-primary btn-sm acceptcookies">
            Got it
        </button>
    </div>
<?php endif; ?>

<footer class="bg-navy p-4 flex-035 d-flex justify-content-center align-items-center">
    <a href="https://github.com/josewebdev2000" class="text-white link-opacity-50-hover mr-4" target="_blank"><i class="bi bi-github h2" id="git-icon"></i></a>
    <span class="mb-3 mb-md-0 text-body-secondary"><a href="https://github.com/josewebdev2000" class="no-underline h3" target="_blank">&copy; josewebdev2000</a></span>
</footer>