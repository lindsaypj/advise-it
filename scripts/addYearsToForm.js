
const schoolYears = document.getElementById("schoolYears");
const prevYearBtn = document.getElementById("prevYearBtn");
const nextYearBtn = document.getElementById("nextYearBtn");

// Handle next Year button click
nextYearBtn.onclick = () => {
    const nextYear = parseInt(schoolYears.lastElementChild.id) + 1;

    // Prevent adding years beyond 2040
    if (nextYear <= 2040) {
        $(schoolYears).append(createNewYear(nextYear));

        // Remove button when max years reached
        if (nextYear >= 2040) {
            nextYearBtn.classList.add("d-none");
        }
    }
}

// Handle previous Year button click
prevYearBtn.onclick = () => {
    const previousYear = parseInt(schoolYears.firstElementChild.id) - 1;
    const currentYear = new Date().getFullYear()

    // Prevent adding years beyond 2 years back
    if (previousYear >= currentYear - 2) {
        $(schoolYears).prepend(createNewYear(previousYear));

        // Remove button when max years reached
        if (previousYear <= currentYear -2) {
            prevYearBtn.classList.add("d-none");
        }
    }
}


function createNewYear(schoolYear) {
    return `
    <div id="${schoolYear}" class="row">
        <div class="col-12 border-bottom mb-2 text-end">
            <h3>${schoolYear}</h3>
        </div>

        <!-- FALL -->
        <div class="col-md-6 col-12 pb-4">
            <div class="form-floating">
                <!-- Notes -->
                <textarea
                    class="form-control quarter-area shadow-sm border-none"
                    placeholder="Leave a comment here"
                    name="schoolYears[${schoolYear}][fall][notes]"
                    id="fall${schoolYear - 1}"
                ></textarea>
                <!-- Calendar Year -->
                <input
                    type="hidden"
                    aria-hidden="true"
                    name="schoolYears[${schoolYear}][fall][calendarYear]"
                    value="${schoolYear - 1}"
                >
                <label for="fall${schoolYear - 1}">Fall ${schoolYear - 1}</label>
            </div>
        </div>

        <!-- WINTER -->
        <div class="col-md-6 col-12 pb-4">
            <div class="form-floating">
                <textarea
                    class="form-control quarter-area shadow-sm border-none"
                    placeholder="Leave a comment here"
                    name="schoolYears[${schoolYear}][winter][notes]"
                    id="winter${schoolYear}"
                ></textarea>
                <input
                    type="hidden"
                    aria-hidden="true"
                    name="schoolYears[${schoolYear}][winter][calendarYear]"
                    value="${schoolYear}"
                >
                <label for="winter${schoolYear}">Winter ${schoolYear}</label>
            </div>
        </div>

        <!-- SPRING -->
        <div class="col-md-6 col-12 pb-4">
            <div class="form-floating">
                <textarea
                    class="form-control quarter-area shadow-sm border-none"
                    placeholder="Leave a comment here"
                    name="schoolYears[${schoolYear}][spring][notes]"
                    id="spring${schoolYear}"
                ></textarea>
                <input
                    type="hidden"
                    aria-hidden="true"
                    name="schoolYears[${schoolYear}][spring][calendarYear]"
                    value="${schoolYear}"
                >
                <label for="spring${schoolYear}">Spring ${schoolYear}</label>
            </div>
        </div>

        <!-- SUMMER -->
        <div class="col-md-6 col-12 pb-4">
            <div class="form-floating">
                <textarea
                    class="form-control quarter-area shadow-sm border-none"
                    placeholder="Leave a comment here"
                    name="schoolYears[${schoolYear}][summer][notes]"
                    id="summer${schoolYear}"
                ></textarea>
                <input
                    type="hidden"
                    aria-hidden="true"
                    name="schoolYears[${schoolYear}][summer][calendarYear]"
                    value="${schoolYear}"
                >
                <label for="summer${schoolYear}">Summer ${schoolYear}</label>
            </div>
        </div>
    </div>`;
}