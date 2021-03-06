﻿.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


Installation de l'extension
---------------------------

L'installation de l'extension *Sphinx Python Documentation Generator and Viewer* se fait en quelques étapes. Si vous
avez déjà installé d'autres extensions par le passé vous aurez peu de surprise ici.

.. note::
	**Utilisateurs MS Windows :** Veuillez commencer par mettre en place votre environnement Python. Les instructions
	sont disponibles dans un :ref:`chapitre à part <windows-setup>`.


Installation de l'extension depuis le gestionnaire d'extensions
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

L'extension *Sphinx Python Documentation Generator and Viewer* peut être installée de façon habituelle en utilisant le
gestionnaire d'extensions de TYPO3.


.. _configure-sphinx:

Téléchargement et configuration de Sphinx
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Depuis le gestionnaire d'extensions, exécutez le script de mise à niveau que cette extension fournit :

.. figure:: ../../../Images/em_update.png
	:alt: Lancement du script de mise à niveau dans le gestionnaire d'extensions

Sélectionnez la version de Sphinx que vous souhaitez utiliser et démarrez le processus d'importation avec le bouton
"import" :

.. figure:: ../../../Images/import_sphinx.png
	:alt: Importation de Sphinx dans l'environnement local

.. important::
	Si la liste des versions disponibles de Sphinx est vide, il est vraisemblable qu'il
	vous `manque le support d'OpenSSL <http://wiki.typo3.org/Exception/CMS/1318283565>`_ dans PHP (c'est un piège
	classique sous MS Windows).

.. index::
	single: Install; Journal
	single: Install; Bibliothèque graphique Python
	single: Install; Python Imaging Library
	single: Install; rst2pdf
	single: Install; PyYAML
	single: Install; Pygments
	single: Install; TYPO3 ReST Tools

Les différents composants devraient s'installer sans écueil. Les éventuels problèmes sont affichés comme messages Flash
et un journal de toutes les opérations est sauvegardé sous :file:`typo3temp/tx_sphinx/IMPORT-{date}.log`. Le processus
général d'importation de Sphinx est le suivant :

#. Récupération de la version comme archive zip depuis https://github.com/sphinx-doc/sphinx/releases dans
   le répertoire :file:`typo3temp/`

#. Extraction de l'archive zip dans le répertoire :file:`uploads/tx_sphinx/{version}/`

#. Compilation des bibliothèques Python dans le répertoire :file:`typo3temp/tx_sphinx/sphinx-doc/{version}/`

#. *[Pas sous MS Windows, autres systèmes : si activé]* Installation de la bibliothèque graphique Python
   (https://pypi.python.org/pypi/PIL), nécessaire pour supporter les formats d'images courants avec :program:`rst2pdf`

#. *[Pas sous MS Windows, autres systèmes : si activé]* Installation de :program:`rst2pdf` (http://rst2pdf.ralsina.com.ar/),
   comme méthode simple pour générer des PDF

#. Récupération des extensions facultatives pour Sphinx: https://bitbucket.org/birkenfeld/sphinx-contrib/

#. Installation de la bibliothèque PyYAML (http://pyyaml.org/wiki/PyYAML), nécessaire pour générer la documentation TYPO3

#. Installation de la bibliothèque Pygments (http://pygments.org/), et configuration de la coloration syntaxique pour
   le code TypoScript

#. Installation des commandes liées à TYPO3 fournies par l'équipe de documentation (utilitaires ReST TYPO3)

Les boutons d'installation manuelle vous permettent de modifier les fichiers et de recompiler votre environnement. C'est
particulièrement pratique si vous souhaitez utiliser le `dépôt git des utilitaires ReST TYPO3`_ au lieu d'un instantané
(*snapshot*).

Le bouton "download" récupère les sources correspondantes de Sphinx, les commandes liées à TYPO3 la bibliothèque PyYAML,
la bibliothèque Pygments, ... si elles ne sont pas disponibles localement.

.. important::
	Il est connu que la bibliothèque graphique Python et/ou :program:`rst2pdf` peuvent ne pas s'installer et
	se configurer avec succès sur certains systèmes. Cependant, comme ces bibliothèques ne sont utilisées que
	pour générer un PDF avec :program:`rst2pdf` et que de toute façon la méthode recommandée pour générer un
	PDF et d'utiliser :ref:`LaTeX <rendering-pdf>`, vous ne devriez pas prêter trop attention à cette erreur
	si vous ne pouvez pas installer :program:`rst2pdf` localement.

.. tip::
	Si la commande :program:`git` est détectée sur votre système, le dépôt Git sera cloné au lieu de télécharger une
	fois pour toutes les commandes liées à TYPO3. Cependant, si cette étape échoue, ou que :program:`git` n'est pas
	trouvée, vous pouvez préférer cloner le dépôt Git officiel manuellement.

	Pour cela, ouvrez un terminal et exécutez :

	.. code-block:: bash

		$ cd /path/to/uploads/tx_sphinx/
		$ sudo rm -rf RestTools
		$ git clone git://git.typo3.org/Documentation/RestTools.git

Le bouton "build" (re)compile la version correspondante de l'environnement Sphinx avec les commandes liées à TYPO3,
PyYAML, Pygments, la bibliothèque graphique Python et :program:`rst2pdf`. **Bon à savoir :** Le support TypoScript pour
Pygments est automatiquement mis à jour, si nécessaire, lors de la recompilation de votre environnement Sphinx.

Pour terminer, le bouton "remove" supprime à la fois les sources et la version correspondante de l'environnement Sphinx.

.. important::
	Ce bouton *NE VA PAS* supprimer les sources des commandes liées à TYPO3, de la bibliothèque PyYAML, de Pygments, de
	la bibliothèque graphique Python ou de :program:`rst2pdf`.

.. Liens :
.. _`dépôt Git des utilitaires ReST TYPO3`: https://git.typo3.org/Documentation/RestTools.git/


Choix de la version de Sphinx à utiliser
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Depuis le gestionnaire d'extensions, configurez l'extension de façon habituelle :

.. figure:: ../../../Images/em_configure.png
	:alt: Configuration de l'extension dans le gestionnaire d'extensions

Le premier onglet "basic" vous permet de choisir quelle version de Sphinx vous souhaitez utiliser pour
générer vos documents :

.. figure:: ../../../Images/em-sphinx-version.png
	:alt: Configuration de la version de Sphinx à utiliser par défaut


Choix de la méthode de rendu PDF
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. index::
	single: PDF; LaTeX
	single: PDF; rst2pdf

Le deuxième onglet "pdf" vous permet de choisir le générateur PDF vous préférez (:program:`rst2pdf` ou LaTeX) et si vous
désirez installer et configurer :program:`rst2pdf` :

.. figure:: ../../../Images/em-pdf.png
	:alt: Configuration du générateur PDF à utiliser

.. tip::
	**Sauf pour les utilisateurs MS Windows,** :program:`rst2pdf` est disponible par défaut avec cette extension.
	Cependant, si vous souhaitez un meilleur rendu, vous devriez plutôt utiliser LaTeX. Veuillez consulter le
	chapitre :ref:`admin-rendering-pdf` pour plus d'information.


.. _install-plugins:

Choix des modules complémentaires à installer
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. index::
	pair: Modules; Google Chart
	pair: Modules; Google Maps
	pair: Modules; HTTP Domain
	pair: Modules; YouTube
	pair: Modules; Slideshare

Le troisième onglet "plugins" vous permet d'activer des extensions Sphinx complémentaires. Certaines
de ces extensions (ou modules) sont disponibles sur docs.typo3.org et conviennent donc à une utilisation dans vos
manuels d'extensions :

.. figure:: ../../../Images/em-plugins.png
	:alt: Configuration des extensions à installer

Veuillez lire le chapitre :ref:`third-party-plugins` pour comprendre comment les utiliser dans vos documents.

.. important::
	Assurez-vous de :ref:`régénérer votre environnement Sphinx <configure-sphinx>` après l'activation de nouveaux
	modules.


.. _speed-up-rendering:

Accélération du rendu des manuels
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Le quatrième onglet "advanced" vous permet d'ajuster des paramètres avancés pour accélérer le rendu.

.. figure:: ../../../Images/em-advanced.png
	:alt: Paramètres avancés
