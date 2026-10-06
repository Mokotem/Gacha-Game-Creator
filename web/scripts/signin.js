


function onMailClick()
{
    email = document.getElementById("email");
    id = document.getElementById("idd");
    id.hidden = true;
    id.required = false;

    email.hidden = false;
    email.required = true;
}

function onIdClick()
{
    email = document.getElementById("email");
    id = document.getElementById("idd");
    id.hidden = false;
    id.required = true;

    email.hidden = true;
    email.required = false;
}
