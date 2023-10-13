import "./bootstrap";

// import teste from "@/test";
// import "~bootstrap/css/bootstrap.min.js";

console.log("heloooooo");

// $(document).ready(function () {
//     // Verifica se o elemento com a classe "custom-alert" existe
//     if ($(".custom-alert").length > 0) {
//         // Após 5 segundos, oculta o elemento com uma animação de fade
//         setTimeout(function () {
//             $(".custom-alert").fadeOut(500, function () {
//                 // Remove o elemento do DOM após a animação
//                 $(this).remove();

//                 // Remova a mensagem da sessão (assumindo que você esteja usando Laravel)
//                 $.ajax({
//                     url: "{{ route('clear.session.message') }}",
//                     method: "GET",
//                     success: function (response) {
//                         // A mensagem da sessão foi removida com sucesso
//                         console.log("sessão removida com sucesso");
//                     },
//                     error: function (error) {
//                         console.log(
//                             "Erro ao remover a mensagem da sessão:",
//                             error
//                         );
//                     },
//                 });
//             });
//         }, 5000); // 5000 milissegundos = 5 segundos
//     }
// });

window.addEventListener("DOMContentLoaded", (event) => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector("#sidebarToggle");
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener("click", (event) => {
            event.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
            localStorage.setItem(
                "sb|sidebar-toggle",
                document.body.classList.contains("sb-sidenav-toggled")
            );
        });
    }
});
