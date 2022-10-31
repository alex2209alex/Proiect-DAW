<!doctype html>
<html lang="en">
    <?php include '../templates/head.php';?>
    <body>
    <?php include '../templates/menu.php';?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5>Cazuri de utilizare</h5>
                <p>Un spital in general presteaza urmatoarele servicii catre pacienti: consultatii de specialitate, recoltare probe si efectuare analize laborator, etc.</p>
                <p>Pentru a accesa functionalitatile aplicatiei orice utilizator trebuie sa aiba un cont in aplicatie.</p>
                <p>Actorii identificati in aplicatie sunt: medic, pacient, laborant si administor aplicatie.</p>
                <p><strong>Ce poate face un pacient in aplicatie?</strong>
                    <ol>
                        <li>
                            Creare cont in aplicatie
                            <ul>
                                <li>pacientul acceseaza functionalitatea creeare cont nou</li>
                                <li>sistemul afiseaza un formular ce contine urmatoarele campuri de completat: email, parola, confirmare parola</li>
                                <li>pacientul completeaza formularul si apoi apasa butonul trimite</li>
                                <li>sistemul valideaza informatile trimise, le salveaza si trimite pe mail un cod de activare.</li>
                            </ul>
                        </li>
                        <li>
                            Activare cont
                            <ul>
                                <li>pacientul acceseaza functionalitatea activare cont</li>
                                <li>sistemul afiseaza un formular ce contine urmatoarele campuri de completat: email, cod activare</li>
                                <li>pacientul completeaza formularul si apoi apasa butonul trimite</li>
                                <li>sistemul valideaza informatile trimise si activeaza contul</li>
                            </ul>
                        </li>
                        <li>
                            Autentificare in aplicatie
                            <ul>
                                <li>utilizatorul acceseaza functionalitatea autentificare in aplicatie</li>
                                <li>sistemul afiseaza un formular ce contine urmatoarele campuri de completat: email, parola</li>
                                <li>utilizatorul completeaza formularul si apoi apasa butonul trimite</li>
                                <li>sistemul valideaza informatile trimise si apoi afiseaza functionalitatile la care are acces utilizatorul conform rolurilor</li>
                            </ul>
                        </li>
                        <li>
                            Programare online la o consultatie
                            <ul>
                                <li>utilizatorul trebuie sa fie autentificat in aplicatie cu rol de pacient</li>
                                <li>pacientul acceseaza functionalitatea programare onlinela o consultatie</li>
                                <li>sistemul afiseaza un formular ce contine urmatoarele campuri de completat: nume, prenume, specialitate, medic, data programarii consultatiei, ora programarii consultatiei</li>
                                <li>sistemul valideaza informatile trimise si trimite un email de confirmare a programarii pentru consultatie</li>
                            </ul>
                        </li>
                        <li>
                            Programare online la analize de laborator
                            <ul>
                                <li>utilizatorul trebuie sa fie autentificat in aplicatie cu rol de pacient</li>
                                <li>pacientul acceseaza functionalitatea programare onlinela analize</li>
                                <li>sistemul afiseaza un formular ce contine urmatoarele campuri de completat: nume, prenume, analize, data programarii pentru recoltare, ora programarii pentru recoltare</li>
                            </ul>
                        </li>
                        <li>
                            Consultare rezultate analize
                        </li>
                    </ol>
                </p>
                <p>
                    <strong>Ce poate face un medic in aplicatie?</strong>
                    <ol>
                        <li>Autentificare in aplicatie</li>
                        <li>Completare fise de consultatie
                            <ul>
                                <li>utilizatorul trebuie sa fie autentificat in aplicatie cu rol de medic</li>
                                <li>sistemul afiseaza o lista cu programariile la consultatie din ziua curenta</li>
                                <li>medicul selecteaza o consultatie din lista</li>
                                <li>sistemul afiseaza fisa de consultatie care are precompletat campurile numele si prenumele pacientului</li>
                                <li>fisa de consultatie contine urmatoarele campuri de comletat: diagnostic, analize recomandate, tratament medicamentos recomandat, investigatii recomandate(ecografie abdominala, mamografie, ...), alergii, boli cronice</li>
                            </ul>
                        </li>
                        <li>Vizualizare rezultate analize ale unui pacient ce are programata o consultatie
                            <ul>
                                <li>utilizatorul trebuie sa fie autentificat in aplicatie cu rol de medic</li>
                                <li>sistemul afiseaza lista cu rezultate analize ale tuturor pacientilor ce au sau au avut programare la medicul autentificat. un medic poate vedea doar rezultatele analizelor pentru pacientii sai</li>
                            </ul>
                        </li>
                    </ol>
                </p>
                <p>
                    <strong>Ce poate face un laborant in aplicatie?</strong>
                    <ol>
                        <li>Autentificare in aplicatie</li>
                        <li>Completare rezultate analize</li>
                    </ol>
                </p>
                <p>
                    <strong>Ce poate face un administrator in aplicatie?</strong>
                    <ol>
                        <li>Autentificare in aplicatie</li>
                        <li>Creare utilizator medic</li>
                        <li>Creare utilizator laborant</li>
                    </ol>
                </p>
                <p>Mai jos este o diagrama a cazurilor de utilizare.</p>
                <img src="/images/cazuri-utilizare.jpg" class="img-fluid" alt="diagrama cazuri de utilizare">
            </div>
        </div>
    </div>
    </body>
</html>