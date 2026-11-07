var bisZu;
var summe;
bisZu=prompt("Bitte geben Sie Zahl, bis zu der summiert wird, ein", "");
bisZu=parseInt(bisZu);
summe=0
for(i=1; i<=bisZu; i++)
{
	summe=summe+i;
}
document.write ("Die Summe der ersten " + bisZu +
					" natürlichen Zahlen " +
					" ist: " + summe);