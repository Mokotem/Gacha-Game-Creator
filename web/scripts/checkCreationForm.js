

function CheckAccount()
{
    if (checkEstNom("uname"))
    {
        valid = document.forms["form1"]["password"].value === document.forms["form1"]["cPassword"].value;

        if (!valid)
        {
            box = document.getElementById("cpasswordBox");
            if (box.hidden)
            {
                box.hidden = false;
                errorAt("cpswd", "");
            }
            else
            {
                errorAt("cpswd", "nope.");
            }

            return false;
        }

        return true;
    }

    document.getElementById("cpasswordBox").hidden = true;
    releaseError("cpswd");

    return false;
}
