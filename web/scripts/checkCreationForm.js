
function isAlpha(code)
{
    return (code > 64 && code < 91) || (code > 96 && code < 123);
}

function isAlphaNumeric(str)
{
    var code, i;

    for (i = 0; i < str.length; i++)
    {
        code = str.charCodeAt(i);
        if (!(code > 47 && code < 58) && // numeric (0-9)
            !isAlpha(code))
        { // lower alpha (a-z)
            return false;
        }
    }
    return true;
}

function Check()
{
    form = document.forms["form1"];
    errored = false;

    if (!isAlphaNumeric(form["uname"].value))
    {
        errorAt("nameError", "special characters and spaces are not allowed.");
        errored = true;
    }
    else if (!isAlpha(form["uname"].value.charCodeAt(0)))
    {
        errorAt("nameError", "first character must be a letter.");
        errored = true;
    }
    else
    {
        errorAt("nameError", "");
    }

    if (!isAlphaNumeric(form["pswd"].value))
    {
        errorAt("passwordError", "special characters and spaces are not allowed.");
        errored = true;
    }
    else
    {
        errorAt("passwordError", "");
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
