function isAlpha(code)
{
    return (code > 64 && code < 91) || (code > 96 && code < 123)
}
function isAlphaOrSpace(code)
{
    return isAlpha(code) || code === " ".charCodeAt(0)
}

function isAlphaNumeric(str)
{
    var code, i;

    for (i = 1; i < str.length; i++)
    {
        code = str.charCodeAt(i);
        if (!(code > 47 && code < 58) && // numeric (0-9)
            !isAlphaOrSpace(code))
        { // lower alpha (a-z)
            return false;
        }
    }
    return true;
}

function Check()
{
    if (isAlphaNumeric(document.forms["form1"].value[0] === ' '))
    {
        document.getElementById("titleError").innerHTML = "must start with a letter.";
        return false;
    }

    if (!isAlphaNumeric(document.forms["form1"].value))
    {
        document.getElementById("titleError").innerHTML = "special characters are not allowed.";
        return false;
    }
    return true;
}