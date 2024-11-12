@extends('layouts.master')
@section('other-css-files')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mstepper.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-wizard.css') }}">
@endsection
@section('page-title')
    Credit Agricol
@endsection
@section('ariane')
    <li class="breadcrumb-item">
        <a href="/dashboard">Accueil</a>
    </li>
    <li class="breadcrumb-item">
        <a class="" href="{{ route('credit.loan') }}">Credit Agricol</a>
    </li>
    <li class="breadcrumb-item">
        <a class="yellow-text" href="#">Demande Credit</a>
    </li>
@endsection
@section('main_content')
    <div class="users-list-table">

        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content pb-0">
                        <div class="card-header mb-2">
                            <h4 class="card-title">Demande de Credit et Analyse de Risque</h4>
                        </div>
                        <form action="{{ route('credit.store') }}" method="POST" id="form_score">
                            @csrf
                            <ul class="stepper horizontal">
                                {{-- <li class="step active">
                                <div class="step-title waves-effect">Demande De Credit</div>
                                <div class="step-content">
                                    <!-- Your step content goes here (like inputs or so) -->
                                    <div class="row">
                                        <div class="input-field col m6 s12">
                                            <label for="firstName">First Name: <span class="red-text">*</span></label>
                                            <input type="text" id="firstName" name="firstName" class="validate" required>
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <label for="lastName">Last Name: <span class="red-text">*</span></label>
                                            <input type="text" id="lastName" class="validate" name="lastName" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col m6 s12">
                                            <label for="Email1">Email: <span class="red-text">*</span></label>
                                            <input type="email" class="validate" name="Email" id="Email1" required>
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <label for="contactNum1">Contact Number: <span class="red-text">*</span></label>
                                            <input type="number" value=1 class="validate" name="contactNum" id="contactNum1"
                                                required>
                                        </div>
                                    </div>
                                    <div class="step-actions">
                                        <!-- Here goes your actions buttons -->
                                        <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
                                    </div>
                                </div>
                            </li> --}}
                                <li class="step active">
                                    <div class="step-title waves-effect">Projet</div>
                                    <div class="step-content">
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="number_of_jobs_created">Nombre d'Emplois cree grace au projet:
                                                    <span class="red-text">*</span></label>
                                                <input type="number" placeholder=1 id="number_of_jobs_created"
                                                    name="number_of_jobs_created" class="validate" required>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label for="operatingIncome">Revenu de l'exploitation: <span
                                                        class="red-text">*</span></label>
                                                <input type="number" placeholder=1 id="operatingIncome" class="validate"
                                                    name="operatingIncome" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="first_entrepreneur_experience">Avez vous une experience
                                                    entrepreneuriale: <span class="red-text">*</span></label>
                                                <select class="validate" name="first_entrepreneur_experience"
                                                    id="first_entrepreneur_experience" required>
                                                    <option value="" selected></option>
                                                    <option value="yes">OUI</option>
                                                    <option value="no">NON</option>
                                                </select>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label class="pb-4" for="experience_with_speculation">Avez vous de
                                                    l'experience sur la speculation envisagee: <span
                                                        class="red-text">*</span></label>
                                                <select class="validate " name="experience_with_speculation"
                                                    id="experience_with_speculation" required>
                                                    <option value="" selected></option>
                                                    <option value="yes">OUI</option>
                                                    <option value="no">NON</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="input-field col m6 s12">
                                                <label for="current_cash">De combien disposez vous en ce moment: <span
                                                        class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate" name="current_cash"
                                                    id="current_cash" required>
                                            </div>
                                            {{-- <div class="input-field col m6 s12">
                                            <label for="current_cash">De quoi combien disposez vous en ce moment: <span
                                                    class="red-text">*</span></label>
                                            <input type="number" placeholder=1 class="validate" name="current_cash" id="current_cash"
                                                required>
                                        </div> --}}
                                        </div>

                                        <div class="step-actions">
                                            <!-- Here goes your actions buttons -->
                                            {{-- <button class="waves-effect waves-dark btn-flat previous-step">BACK</button> --}}
                                            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="step">
                                    <div class="step-title waves-effect">Speculations</div>
                                    <div class="step-content">
                                        <!-- Your step content goes here (like inputs or so) -->
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="plans_speculation">Quelle Speculation voulez vous lancer? <span
                                                        class="red-text">*</span></label>
                                                <input type="text" class="validate" name="plans_speculation"
                                                    id="plans_speculation" required>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label for="production_duration">Duree de la production (Mois) <span
                                                        class="red-text">*</span></label>
                                                <input type="text" class="validate" name="production_duration"
                                                    id="production_duration" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="plans_surface_launch">Superficie prevu pour le projet (m2):
                                                    <span class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate" name="plans_surface_launch"
                                                    id="plans_surface_launch" required>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label for="sales_channel">Ou allez vous vendre votre production: <span
                                                        class="red-text">*</span></label>
                                                <input type="text" class="validate" name="sales_channel"
                                                    id="sales_channel" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="selling_price">À combien (fr/kg)
                                                    <span class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate" name="selling_price"
                                                    id="selling_price" required>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label for="grossMargin">Taux de marge brute: <span
                                                        class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate" name="grossMargin"
                                                    id="grossMargin" required>
                                            </div>
                                        </div>
                                        <div class="step-actions">
                                            <!-- Here goes your actions buttons -->
                                            <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                                            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="step">
                                    <div class="step-title waves-effect">Depenses</div>
                                    <div class="step-content">
                                        <!-- Your step content goes here (like inputs or so) -->
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="preharvest_expenses">À combien estimez-vous le montant des
                                                    activités de lancement de la production <span
                                                        class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate" name="preharvest_expenses"
                                                    id="preharvest_expenses" required>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label for="harvesting_expenses">À combien estimez-vous les dépenses lors
                                                    de la production <span class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate" name="harvesting_expenses"
                                                    id="harvesting_expenses" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="postharvest_expenses">À combien estimez-vous les dépenses post
                                                    maturation ? <span class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate"
                                                    name="postharvest_expenses" id="postharvest_expenses" required>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label for="amortization_of_investment">À combien estimez-vous
                                                    l'amortissement
                                                    des équipements ? <span class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate"
                                                    name="amortization_of_investment" id="amortization_of_investment"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="other_financial_income">A combien estimez-vous les
                                                    revenus secondaires de ce projet ? <span
                                                        class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate"
                                                    name="other_financial_income" id="other_financial_income" required>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label for="other_debts">Autre dettes à rembourser
                                                    <span class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate" name="other_debts"
                                                    id="other_debts" required>
                                            </div>
                                        </div>
                                        <div class="step-actions">
                                            <!-- Here goes your actions buttons -->
                                            <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                                            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="step">
                                    <div class="step-title waves-effect">Credit</div>
                                    <div class="step-content">
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="loan_amount_requested">Quel est le montant du crédit sollicité
                                                    <span class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate"
                                                    name="loan_amount_requested" id="loan_amount_requested" required>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label for="loan_duration">Quelle est la durée du crédit (Mois)
                                                    ?<span class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate" name="loan_duration"
                                                    id="loan_duration" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="investment_requirements">À combien estimez-vous votre besoin en
                                                    investissement <span class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate"
                                                    name="investment_requirements" id="investment_requirements" required>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label for="totalOperatingExpenses">Montant du prêt / Total des dépenses
                                                    d'exploitation <span class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate"
                                                    name="totalOperatingExpenses" id="totalOperatingExpenses" required>
                                            </div>
                                        </div>
                                        <div class="step-actions">
                                            <!-- Here goes your actions buttons -->
                                            <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                                            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="step">
                                    <div class="step-title waves-effect">Revenue</div>
                                    <div class="step-content">
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="other_financial_income">Revenue<span
                                                        class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate"
                                                    name="other_financial_income" id="other_financial_income" required>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label for="other_financial_income_desc">Description Autre Revenue<span
                                                        class="red-text">*</span></label>
                                                <input type="text" placeholder=1 class="validate"
                                                    name="other_financial_income_desc" id="other_financial_income_desc"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="farmland_and_buildings_value">Valeur des terres et
                                                    Batiments<span class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate"
                                                    name="farmland_and_buildings_value" id="farmland_and_buildings_value"
                                                    required>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label for="equipments_and_tooling_value">Valeur Outils et Materiels
                                                    Agricoles<span class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate"
                                                    name="equipments_and_tooling_value" id="equipments_and_tooling_value"
                                                    required>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="total_receivable">Valeur de la production vendue non paye<span
                                                        class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate" name="total_receivable"
                                                    id="total_receivable" required>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label for="stocked_production_value">Quelle est la valeur de votre
                                                    stock<span class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate"
                                                    name="stocked_production_value" id="stocked_production_value"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="step-actions">
                                            <!-- Here goes your actions buttons -->
                                            <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                                            <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="step">
                                    <div class="step-title waves-effect">Divers</div>
                                    <div class="step-content">
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="family_expenses">Depenses familiales<span
                                                        class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate" name="family_expenses"
                                                    id="family_expenses" required>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label for="financialExpenses">Depenses financieres<span
                                                        class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate" name="financialExpenses"
                                                    id="financialExpenses" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="operatingIncomeTimeNumberOfCycle">Revenu D'eploitation<span
                                                        class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate"
                                                    name="operatingIncomeTimeNumberOfCycle"
                                                    id="operatingIncomeTimeNumberOfCycle" required>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <label for="other_assets">Valeur des autres biens personnels <span
                                                        class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate" name="other_assets"
                                                    id="other_assets" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="totalAsset">Total des passifs <span
                                                        class="red-text">*</span></label>
                                                <input type="number" placeholder=1 class="validate" name="totalAsset"
                                                    id="totalAsset" required>
                                            </div>
                                        </div>
                                        <div class="step-actions">
                                            <!-- Here goes your actions buttons -->
                                            {{-- <button class="waves-effect waves-dark btn-flat previous-step">Brouillon</button> --}}
                                            <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
                                            {{-- <a type="submit" class="btn"></a> --}}
                                            <button id="voirScoreBtn" type="button" class="waves-effect waves-dark btn">Voir Score</button>
                                            <button type="submit" class="waves-effect waves-dark btn">Soumettre</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="mb-3 padding-2" id="resultAnalyse" style="display: none;">

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('other-js-script')
    <script src="{{ asset('assets/js/mstepper.js') }}"></script>

    <script>
        var stepper = document.querySelector('.stepper');
        var stepperInstace = new MStepper(stepper, {
            // options
            firstActive: 0 // this is the default
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#resultAnalyse').hide(); // Masquer le div de résultat au départ

            // Événement au clic pour le bouton "Voir Score"
            $('#voirScoreBtn').click(function() {
                $('#resultAnalyse').hide();  // Masquer le div avant d'afficher les nouvelles données
                $('#resultAnalyse').empty();

                var form = $("#form_score");
                var actionUrl = "https://green-api-v2.vercel.app/api/loan_form/scoring/GreenAPI/agriculture";

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    headers: {
                        "API-KEY": "WE58922036633MVTE852000SWQPA-AKZ"
                    },
                    data: form.serialize(),
                    success: function(data) {
                        console.log(data);
                        let message = '<div>' +
                            '<span class="red-text padding-2">Eligibilite: ' + data.riskAnalysis.eligibility.description + '</span><br/>' +
                            '<span class="orange-text padding-2">Medium Risk: ' + data.riskAnalysis.mediumRisks.toString() + '</span><br/>' +
                            '<span class="orange-text padding-2">Severe Risk: ' + data.riskAnalysis.severeRisks.toString() + '</span>' +
                            '</div>';

                        $('#resultAnalyse').append(message);
                        $('#resultAnalyse').show();  // Afficher le div de résultat avec le message
                    }
                });
            });
        });
    </script>

@endsection
