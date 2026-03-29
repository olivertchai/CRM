<!DOCTYPE html>
<html class="light" lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Roster - Criar Nova Campanha</title>

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
    <div class="layout-container flex h-full grow flex-col">
      <!-- Top Navigation Bar -->
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
              class="text-slate-600 dark:text-slate-300 text-sm font-medium hover:text-primary transition-colors"
              href="#"
              >Campanhas</a
            >
            <a
              class="text-primary text-sm font-bold border-b-2 border-primary pb-1"
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

      <main class="flex-1 flex justify-center py-8 px-4 lg:px-40">
        <div class="max-w-4xl w-full flex flex-col gap-8">
          <!-- Page Header -->
          <div
            class="flex flex-col md:flex-row md:items-center justify-between gap-4"
          >
            <div class="flex items-center gap-4">
              <button
                class="flex items-center justify-center rounded-xl h-10 w-10 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-200 transition-colors"
              >
                <span class="material-symbols-outlined">
                  arrow_back
                </span>
              </button>

              <div class="flex flex-col">
                <h1 class="text-3xl font-bold tracking-tight">
                  Criar Nova Campanha
                </h1>
                <p
                  class="text-slate-500 dark:text-slate-400 text-sm"
                >
                  Crie e configure uma nova campanha de marketing
                </p>
              </div>
            </div>
          </div>

          <!-- Form Section -->
          <section
            class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-6 lg:p-8 shadow-sm"
          >
            <div class="mb-8">
              <h2 class="text-xl font-bold mb-2">
                Informações da Campanha
              </h2>
              <p class="text-slate-500 dark:text-slate-400">
                Preencha os dados abaixo para configurar sua nova campanha de marketing.
              </p>
            </div>

            <form class="flex flex-col gap-6">
              <!-- Row 1 -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <label class="flex flex-col gap-2">
                  <span
                    class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                    >Título</span
                  >
                  <input
                    class="rounded-xl border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-primary focus:border-primary px-4 py-3 h-12 w-full text-sm"
                    placeholder="Ex: Campanha de Verão 2024"
                    type="text"
                  />
                </label>

                <label class="flex flex-col gap-2">
                  <span
                    class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                    >URL da Imagem</span
                  >
                  <input
                    class="rounded-xl border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-primary focus:border-primary px-4 py-3 h-12 w-full text-sm"
                    placeholder="https://exemplo.com/imagem.jpg"
                    type="text"
                  />
                </label>
              </div>

              <!-- Description -->
              <label class="flex flex-col gap-2">
                <span
                  class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                  >Descrição</span
                >
                <textarea
                  class="rounded-xl border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-primary focus:border-primary px-4 py-3 w-full text-sm resize-none"
                  placeholder="Descreva os objetivos e detalhes da campanha..."
                  rows="4"
                ></textarea>
              </label>

              <!-- Dates -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <label class="flex flex-col gap-2">
                  <span
                    class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                    >Data de Início</span
                  >
                  <input
                    class="rounded-xl border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-primary focus:border-primary px-4 py-3 h-12 w-full text-sm"
                    type="datetime-local"
                  />
                </label>

                <label class="flex flex-col gap-2">
                  <span
                    class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                    >Data de Término</span
                  >
                  <input
                    class="rounded-xl border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-primary focus:border-primary px-4 py-3 h-12 w-full text-sm"
                    type="datetime-local"
                  />
                </label>
              </div>

              <!-- Lead -->
              <div class="flex flex-col gap-2">
                <span
                  class="text-sm font-semibold text-slate-700 dark:text-slate-200"
                  >Perfil de Lead</span
                >

                <div class="flex gap-3">
                  <select
                    class="flex-1 rounded-xl border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-primary focus:border-primary px-4 py-3 h-12 text-sm"
                  >
                    <option disabled selected value="">
                      Selecione um perfil
                    </option>
                    <option value="1">Interesse em Tecnologia</option>
                    <option value="2">Decisores B2B</option>
                    <option value="3">Varejo High-end</option>
                  </select>

                  <button
                    type="button"
                    class="flex items-center gap-2 px-4 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 text-sm font-semibold hover:bg-slate-200 transition-colors"
                  >
                    <span class="material-symbols-outlined">add</span>
                    Novo Perfil
                  </button>
                </div>
              </div>

              <!-- Actions -->
              <div
                class="flex justify-end gap-4 mt-8 pt-6 border-t border-slate-100 dark:border-slate-800"
              >
                <button
                  type="button"
                  class="px-6 h-12 rounded-xl border border-slate-300 text-sm font-semibold hover:bg-slate-50"
                >
                  Cancelar
                </button>

                <button
                  type="submit"
                  class="px-8 h-12 rounded-xl bg-primary text-white text-sm font-bold hover:opacity-90"
                >
                  Criar Campanha
                </button>
              </div>
            </form>
          </section>
        </div>
      </main>

      <footer
        class="py-8 text-center text-slate-400 dark:text-slate-600 text-xs"
      >
        © 2024 Roster Plataforma de Marketing. Todos os direitos reservados.
      </footer>
    </div>
  </body>
</html>