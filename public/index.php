<<<<<<< HEAD
<?php

echo "Super chat"; 
=======
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Roster - Campanhas</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&amp;display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&amp;display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
      rel="stylesheet"
    />

    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#ec5b13",
              "background-light": "#f8f6f6",
              "background-dark": "#221610",
            },
            fontFamily: {
              display: ["Public Sans"],
            },
            borderRadius: {
              DEFAULT: "0.25rem",
              lg: "0.5rem",
              xl: "0.75rem",
              full: "9999px",
            },
          },
        },
      };
    </script>

    <style>
      body {
        font-family: "Public Sans", sans-serif;
      }
      .material-symbols-outlined {
        font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
      }
    </style>
  </head>

  <body
    class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen"
  >
    <!-- BEGIN: MainHeader -->
    <header
      class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-6 py-3 lg:px-40"
    >
      <div class="flex items-center gap-4">
        <div class="p-1.5 rounded-md bg-primary">
          <svg
            class="w-6 h-6 text-white"
            fill="none"
            stroke="currentColor"
            viewbox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
            ></path>
          </svg>
        </div>
        <h2 class="text-xl font-bold leading-tight tracking-tight">
          Roster
        </h2>
      </div>

      <div class="flex flex-1 justify-end gap-8">
        <nav class="hidden md:flex items-center gap-8">
          <a
            class="text-primary text-sm font-bold border-b-2 border-primary pb-1"
            href="#"
            >Campanhas</a
          >
          <a
            class="text-slate-600 dark:text-slate-300 text-sm font-medium hover:text-primary transition-colors"
            href="#"
            >Criar Campanha</a
          >
          <a
            class="text-slate-600 dark:text-slate-300 text-sm font-medium hover:text-primary transition-colors"
            href="#"
            >Buscar Cliente</a
          >
          <a
            class="text-slate-600 dark:text-slate-300 text-sm font-medium hover:text-primary transition-colors"
            href="#"
            >Usuários</a
          >
        </nav>

        <div class="flex items-center gap-4">
          <div class="flex items-center gap-2 text-right">
            <div class="flex items-center gap-2">
              <div
                class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center"
              >
                <svg
                  class="w-5 h-5 text-slate-500"
                  fill="currentColor"
                  viewbox="0 0 24 24"
                >
                  <path
                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"
                  ></path>
                </svg>
              </div>

              <div class="hidden sm:block text-left">
                <p
                  class="text-sm font-semibold text-slate-900 dark:text-slate-100 leading-none"
                >
                  Usuário Demo
                </p>
                <p
                  class="text-[10px] text-slate-500 dark:text-slate-400"
                >
                  Administrador
                </p>
              </div>
            </div>
          </div>

          <!-- Logout Button -->
          <button
            class="p-2 bg-slate-800 text-white rounded-md hover:bg-slate-700 transition-colors"
            title="Sair"
          >
            <svg
              class="w-5 h-5"
              fill="none"
              stroke="currentColor"
              viewbox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
              ></path>
            </svg>
          </button>
        </div>
      </div>
    </header>
    <!-- END: MainHeader -->

    <!-- BEGIN: MainContent -->
    <main
      class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8"
    >
      <!-- Header Section -->
      <div class="flex justify-between items-start mb-8">
        <div data-purpose="page-title">
          <h1 class="text-3xl font-bold text-slate-900">
            Campanhas
          </h1>
          <p class="text-slate-500 mt-1">
            Gerencie e visualize suas campanhas de marketing
          </p>
        </div>

        <button
          class="bg-primary hover:opacity-90 text-white px-6 py-2.5 rounded-lg font-semibold flex items-center gap-2 transition-all shadow-sm"
        >
          <svg
            class="w-5 h-5"
            fill="none"
            stroke="currentColor"
            viewbox="0 0 24 24"
          >
            <path
              d="M12 4v16m8-8H4"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
            ></path>
          </svg>
          Nova Campanha
        </button>
      </div>

      <!-- Tab Controls -->
      <div
        class="flex gap-1 mb-8 p-1 bg-white border border-gray-200 rounded-lg w-fit"
        data-purpose="tab-navigation"
      >
        <button
          class="px-6 py-2 rounded-md text-sm font-medium border border-gray-200 bg-white hover:bg-gray-50"
        >
          Ativas (0)
        </button>
        <button
          class="px-6 py-2 rounded-md text-sm font-medium bg-slate-900 text-white"
        >
          Concluídas (0)
        </button>
      </div>

      <!-- Empty State Container -->
      <div
        class="bg-white border border-gray-200 rounded-2xl flex flex-col items-center justify-center py-32 px-4 shadow-sm"
        data-purpose="empty-state"
      >
        <!-- Chart Icon -->
        <div class="mb-6 text-slate-400">
          <svg
            class="w-24 h-24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.5"
            viewbox="0 0 24 24"
          >
            <path
              d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"
              stroke-linecap="round"
              stroke-linejoin="round"
            ></path>
          </svg>
        </div>

        <!-- Text -->
        <div class="text-center mb-8">
          <h3 class="text-xl font-bold text-slate-900">
            Nenhuma campanha ativa
          </h3>
          <p class="text-slate-500 mt-2">
            Crie sua primeira campanha para começar
          </p>
        </div>

        <!-- Button -->
        <button
          class="bg-primary hover:opacity-90 text-white px-8 py-3 rounded-lg font-bold flex items-center gap-2 transition-all shadow-md"
        >
          <svg
            class="w-5 h-5"
            fill="none"
            stroke="currentColor"
            viewbox="0 0 24 24"
          >
            <path
              d="M12 4v16m8-8H4"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
            ></path>
          </svg>
          Criar Campanha
        </button>
      </div>
    </main>
    <!-- END: MainContent -->
  </body>
</html>
>>>>>>> 33fee97 (Setup the deafult layout)
