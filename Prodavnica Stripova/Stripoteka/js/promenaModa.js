	if(localStorage.getItem("tema")== "null")
	{
		localStorage.setItem("tema","css/mojstilLight.css");
	}

	let localData = localStorage.getItem("tema");

	if(localData == "css/mojstilLight.css")
	{
		document.getElementById("ikonaMod").setAttribute("src","img/moon.png");
		var lightMode = document.getElementById("idStila").setAttribute("href",localStorage.getItem("tema"));
	}
	else if(localData == "css/mojstilDark.css")
	{
		document.getElementById("ikonaMod").setAttribute("src","img/sun.png");
		var lightMode = document.getElementById("idStila").setAttribute("href",localStorage.getItem("tema"));
	}


	ikonaMod.onclick = function() 
	{
		var slika = document.getElementById("ikonaMod").getAttribute("src");

		if(slika== "img/moon.png")
		{
				localStorage.setItem("tema","css/mojstilDark.css");	//NALAZIM SE U DARK MODU

				document.getElementById("ikonaMod").setAttribute("src","img/sun.png");

				var lightMode = document.getElementById("idStila").setAttribute("href",localStorage.getItem("tema"));

			}
			else if(slika == "img/sun.png")
			{
				localStorage.setItem("tema","css/mojstilLight.css");	//NALAZIM SE U LIGHT MODU

				document.getElementById("ikonaMod").setAttribute("src","img/moon.png");

				var darkMode = document.getElementById("idStila").setAttribute("href",localStorage.getItem("tema"));

			}
			else{
				localStorage.setItem("tema","css/mojstilLight.css");
			}
		}