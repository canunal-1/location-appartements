$(document).ready(function () {
    // Lorsque la cloche est cliquée
    $('.notification').on('click', function () {
        // Afficher/masquer la barre de notification
        $('.notification-bar').toggle();
    });

    // Fonction pour marquer comme lu
    function marquerCommeLu(idNotifQuestion) {
        $.ajax({
            url: './?action=marquerLueQuestion&idNotifQuestion=' + idNotifQuestion,
            type: 'GET',
            success: function (response) {
                console.log(response);
                // Rafraîchir les notifications après marquage comme lu
                chargerNotifications();
            },
            error: function (error) {
                console.error('Erreur lors du marquage comme lu :', error);
            }
        });
    }

    // Lorsque vous cliquez sur "Marquer comme lue"
    $('.lue-notif').on('click', function () {
        // Récupérer l'ID de la notification de question
        var idNotifQuestion = $(this).data('id-notif-question');

        // Vérifier si l'ID est défini
        if (idNotifQuestion !== undefined) {
            // Appeler la fonction pour marquer comme lu
            marquerCommeLu(idNotifQuestion);
        } else {
            console.error('L\'ID de la notification de question n\'est pas spécifié.');
        }
    });
});
