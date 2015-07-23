<?php defined('BASEPATH') OR exit('No direct script access allowed');

// inline help html. Only 'help_body' is used.
$lang['help_body'] = "
<h4>Γενικά</h4>
<p>Το πρόσθετο Πλοήγηση ελέγχει την κύρια περιοχή πλοήγησης όπως και άλλες ομάδες συνδέσμων</p>

<h4>Ομάδες Συνδέσμων Πλοήγησης</h4>
<p>Οι σύνδεσμοι πλοήγησης προβάλλονται ανάλογα με την ομάδα στην οποία βρίσκονται.
Στα περισσότερα θέματα εμφάνισης η ομάδα Header είναι η κύρια πλοήγηση. 
Ελέγξτε την τεκμηρίωση/βοήθεια του θέματος εμφάνισης σας για να δείτε ποιες ομάδες συνδέσμων πλοήγησης υποστηρίζονται μέσα από αυτό. 
Αν θέλετε να προβάλλετε μια ομάδα συνδέσμων πλοήγησης μέσα στο περιεχόμενο του ιστότοπου απλώς χρησιμοποιήστε αυτήν την tag: {{ navigation:links group=\"your-group-name\" }}</p>

<h4>Προσθήκη συνδέσμων</h4>
<p>Επιλέξτε ένα τίτλο για τον σύνδεσμό σας, μετά επιλέξτε την ομάδα μέσα στην οποία θα θέλατε να το προβάλλετε.
Οι τύποι συνδέσμων είναι οι εξής:
<ul>
<li>URL: ένας εξωτερικός σύνδεσμος - http://google.com</li>
<li>Σύνδεσμος Ιστοτόπου: ένας σύνδεσμος μέσα στον ιστότοπό σας - galleries/portfolio-pictures</li>
<li>Πρόσθετο: πηγαίνει στην αρχική σελίδα κάποιου πρόσθετου</li>
<li>Σελίδα: σύνδεσμος σε μια Σελίδα</li>
</ul>
Ο Προορισμός ορίζει αν αυτός ο σύνδεσμος θα πρέπει να ανοίγει σε ένα νέο παράθυρο ή καρτέλα.
(Συμβουλή: να γίνεται χρήση Νέου Παραθύρου σπάνια για να μην ενοχλούντε οι επισκέπτες σας.)
Το πεδίο Class επιτρέπει να προσθέσετε ένα CSS Class σε έναν μεμονωμένο σύνδεσμο.</p>
<p></p>

<h4>Ταξινόμηση Συνδέσμων Πλοήγησης</h4>
<p>Η σειρά με την οποία εμφανίζονται οι σύνδεσμοι στον πίνακα διαχείρισης σας είναι η ίδια που θα εμφανίζονται στον ιστότοπο.
Για να αλλάξετε την σειρά αυτή, απλώς τραβήξτε και αφήστε τον κάθε έναν σύνδεσμο στην θέση του μέχρι να είσαστε ικανοποίημένοι.</p>";