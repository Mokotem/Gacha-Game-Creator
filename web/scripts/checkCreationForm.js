

function Check()
{
    errored = false;

    if (!checkIdIsName("uname"))
    {
        errored = true;
    }

    if (!checkIsAlphaNum("pswd"))
    {
        errored = true;
    }

    if (!errored)
    {
        valid = document.forms["form1"]["cpswd"].value === document.forms["form1"]["pswd"].value;

        if (!valid)
        {
            box = document.getElementById("cpasswordBox");
            if (box.hidden)
            {
                box.hidden = false;
                errorAt("conf", "");
            }
            else
            {
                errorAt("conf", "nope.");
            }

            return false;
        }

        return true;
    }

    document.getElementById("cpasswordBox").hidden = true;
    document.getElementById("cpswd").value = "";

    return false;
}

function errorAt(id, message)
{
    document.getElementById(id).innerHTML = message;
}
