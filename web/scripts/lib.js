

function estAlpha(code)
{
    // table UTF-16
    return (code > 64 && code < 91)
        || (code > 96 && code < 123);
}

function estEspace(code)
{
    return code === 32;
}

function estAlphaouEspace(code)
{
    // table UTF-16
    return estAlpha(code)
        || estEspace(code);
}

function estAlphaouTiret(code)
{
    return estAlpha(code)
        || estTiret(code);
}
function estAlphaouTiretouEspace(code)
{
    return estAlpha(code)
        || estTiret(code)
        || estEspace(code);
}

function estTiret(code)
{
    return code === 45;
}

function estTitre(str, id)
{
    dernierEstTiret = false;

    for (i = 0; i < str.length; i++)
    {
        if (!estAlphaouTiretouEspace(str.charCodeAt(i)))
        {
            errorAt(id, "les caractères spéciaux ne sont pas autorisés.");
            return false;
        }

        if (estTiret(str.charCodeAt(i)))
        {
            if (dernierEstTiret)
            {
                errorAt(id, "les doubles tirets ne sont pas autorisés.");
                return false;
            }

            dernierEstTiret = true;
        }
        else
        {
            dernierEstTiret = false;
        }
    }

    releaseError(id);
    return true;
}

function estNom(str, id)
{
    if (!estTitre(str, id))
    {
        return false;
    }

    for (i = 0; i < str.length; i++)
    {
        if (estEspace(str.charCodeAt(i)))
        {
            errorAt(id, "les espaces ne sont pas autorisés.");
            return false;
        }
    }

    releaseError(id);
    return true;
}

function checkEstNom(id)
{
    return estNom(document.forms["form1"][id].value, id);
}

function checkEstTitle(id)
{
    return estTitre(document.forms["form1"][id].value, id);
}


function errorAt(id, message)
{
    document.getElementById(id + "Error").innerHTML = message;
}
function releaseError(id)
{
    document.getElementById(id + "Error").innerHTML = "";
}