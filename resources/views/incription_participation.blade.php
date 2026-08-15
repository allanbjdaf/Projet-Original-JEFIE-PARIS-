<x-guest-layout>
    <div class="min-h-screen py-10 px-4 sm:px-6 lg:px-8 bg-gray-100 flex items-center justify-center">
        <div class="max-w-2xl w-full bg-white p-8 rounded-xl shadow-lg">

            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900">Formulaire de Candidature</h2>
                <p class="mt-2 text-sm text-gray-600">Rejoignez l'aventure du Forum International 2026</p>
            </div>

            <form action="{{ route('inscription.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- ÉTAPES GÉNÉRALES : Infos de Base --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom complet</label>
                        <input type="text" name="name" required class="mt-1 block w-full p-2.5 border rounded-lg shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Adresse Email</label>
                        <input type="email" name="email" required class="mt-1 block w-full p-2.5 border rounded-lg shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                        <input type="text" name="telephone" required class="mt-1 block w-full p-2.5 border rounded-lg shadow-sm">
                    </div>
                    {{-- 🎯 LE SÉLECTEUR DE RÔLE DYNAMIQUE --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Je candidate en tant que :</label>
                        <select id="roleSelector" name="role" required class="mt-1 block w-full p-2.5 border rounded-lg shadow-sm bg-white">
                            <option value="">-- Choisir une option --</option>
                            <option value="participant_forum">Participant au Forum</option>
                            <option value="benevole">Bénévole</option>
                            <option value="sponsor">Sponsor / Partenaire</option>
                            <option value="intervenant">Intervenant / Speaker</option>
                        </select>
                    </div>
                </div>

                {{-- 🛑 BLOC DYNAMIQUE : SPONSOR --}}
                <div id="bloc-sponsor" class="hidden space-y-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <h3 class="text-md font-bold text-blue-800">💼 Informations Entreprise & Sponsoring</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom de l'entreprise</label>
                        <input type="text" name="entreprise" class="mt-1 block w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Budget estimé ou Type de Pack visé</label>
                        <input type="text" name="budget" placeholder="Ex: Pack Platinum, Support financier..." class="mt-1 block w-full p-2 border rounded-md">
                    </div>
                </div>

                {{-- 🛑 BLOC DYNAMIQUE : BÉNÉVOLE --}}
                <div id="bloc-benevole" class="hidden space-y-4 p-4 bg-green-50 rounded-lg border border-green-200">
                    <h3 class="text-md font-bold text-green-800">🤝 Profil du Bénévole</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Disponibilités durant l'événement</label>
                        <input type="text" name="disponibilites" placeholder="Ex: Tout le forum, Matinées uniquement..." class="mt-1 block w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Domaine de prédilection / Compétences</label>
                        <input type="text" name="competences" placeholder="Ex: Accueil, Logistique, Traduction..." class="mt-1 block w-full p-2 border rounded-md">
                    </div>
                </div>

                {{-- 🛑 BLOC DYNAMIQUE : INTERVENANT --}}
                <div id="bloc-intervenant" class="hidden space-y-4 p-4 bg-purple-50 rounded-lg border border-purple-200">
                    <h3 class="text-md font-bold text-purple-800">🎤 Thématique de l'Intervenant</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sujet d'intervention proposé</label>
                        <input type="text" name="sujet_intervention" class="mt-1 block w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Lien vers votre profil LinkedIn ou Portfolio</label>
                        <input type="url" name="linkedin" class="mt-1 block w-full p-2 border rounded-md">
                    </div>
                </div>

                {{-- CHAMP MUTUEL : Motivations --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Parlez-nous brièvement de votre projet / motivation</label>
                    <textarea name="motivation" rows="3" required class="mt-1 block w-full p-2.5 border rounded-lg shadow-sm"></textarea>
                </div>

                {{-- Bouton de soumission --}}
                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 transition focus:outline-none">
                        Envoyer ma candidature
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- 💡 SCRIPT DE GESTION DES CHAMPS DYNAMIQUES --}}
    <script>
        document.getElementById('roleSelector').addEventListener('change', function() {
            const role = this.value;

            // Masquer tous les blocs spécifiques par défaut
            document.getElementById('bloc-sponsor').classList.add('hidden');
            document.getElementById('bloc-benevole').classList.add('hidden');
            document.getElementById('bloc-intervenant').classList.add('hidden');

            // Afficher uniquement le bloc correspondant au choix
            if (role === 'sponsor') {
                document.getElementById('bloc-sponsor').classList.remove('hidden');
            } else if (role === 'benevole') {
                document.getElementById('bloc-benevole').classList.remove('hidden');
            } else if (role === 'intervenant') {
                document.getElementById('bloc-intervenant').classList.remove('hidden');
            }
        });
    </script>
</x-guest-layout>