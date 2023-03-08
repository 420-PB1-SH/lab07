#include <iostream>
#include <SFML/Network.hpp>

#include "TicTacToe.h";

using namespace std;

void jouer(bool estServeur, unsigned short port);

void saisirPosition(int& ligne, int& colonne, char lettreJoueur);

int main()
{
	const unsigned short PORT = 54000;
	int choixOption;

	setlocale(LC_ALL, "");

	while (true) {
		cout << "TIC TAC TOE" << endl
			<< "===========" << endl << endl
			<< "Choisir une option: " << endl
			<< "1. Créer une partie" << endl
			<< "2. Joindre une partie" << endl << endl;

		do {
			cout << "Votre choix: ";
			cin >> choixOption;
		} while (choixOption != 1 && choixOption != 2);

		if (choixOption == 1) {
			jouer(true, PORT);
		}
		else {
			jouer(false, PORT);
		}

		cout << endl;
		system("pause");
		system("cls");
	}
}

void jouer(bool estServeur, unsigned short port) {
}

void saisirPosition(int& x, int& y, char lettreJoueur) {
	char saisieLigne;
	int saisieColonne;

	do {
		cout << "Où voulez-vous placer votre " << lettreJoueur << "?" << endl
			<< "ligne colonne : ";
		cin >> saisieLigne >> saisieColonne;
	} while (saisieLigne < 'a' || saisieLigne > 'c' || saisieColonne < 1 || saisieColonne > 3);

	x = saisieLigne - 'a';
	y = saisieColonne - 1;
}
