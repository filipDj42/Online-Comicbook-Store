function citati(){

	citatiNiz = new Array(6);
	autoriNiz = new Array (6);

	citatiNiz[0]= "Ajmo pošteno, šta je uopšte moj život? Strip u kome je glavni junak neko drugi!";
	autoriNiz[0]= "Gručo (Horor zabavnik)";

	citatiNiz[1]= "Kad porastem biću patuljak u cirkusu"; 
	autoriNiz[1]= "Gručo";

	citatiNiz[2]= "Dosađivao sam se gledajući televizor,pa sam pomislio kako su srećni u Veneciji: Imaju milion kanala!";
	autoriNiz[2]= "Gručo (nasumičnoj prolaznici)"; 

	citatiNiz[3]= "Da li je istina da Italijom vlada mafija? Pobogu, pa zašto ste glasali za nju?";
	autoriNiz[3]= "Gručo (Tajanstvena stvar koja živi iza frižidera)";

	citatiNiz[4]= "Šta misliš da izađemo na večeru i proslavimo našu nultu godišnjicu?";
	autoriNiz[4]= "Gručo, udvarač (Kraljica Tame)";

	citatiNiz[5]= "Nemam više para ni za cigarete, sva sreća što ne pušim.";
	autoriNiz[5]= "Gručo (Uspomene nevidljivog)";

	citatiNiz[6]= "Čemu žurba? Da niste našli NLO u birou za izgubljene stvari?";
	autoriNiz[6]= "Gručo (Delirijum)";

	index = Math.floor(Math.random() * citatiNiz.length);

	document.getElementById("citat").innerHTML = citatiNiz[index];
	document.getElementById("autor").innerHTML = autoriNiz[index];
}



 




