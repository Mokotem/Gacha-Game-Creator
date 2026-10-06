

<script>
function onClick()
{
    document.getElementById("aaa").style = "display:none";
}
</script>
<div class="message" id="aaa">
    <p><?= $message ?></p>
    <button onclick="onClick()">ok</button>
</div>