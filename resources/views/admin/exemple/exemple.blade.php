@extends('base')

@section('title', "CALENDRIER")

@section('head')
    <!-- Inclusion du token CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')

    <!-- --------------------- Main --------------------- -->
    <section id="content">
        <main>
            <div class="head-title">
                <div class="left">
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Calendrier</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="{{ route('admin.calendrier.index') }}">Page Calendrier</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="table-date">

                <div class="todo">
                    <ul class="todo-list todo-color">
                        <div class="wrapper">
                            <div class="container-calendar">
                                <div id="left">
                                    <h1>DYNAMIC CALENDAR</h1>
                                    <div id="event-section">
                                        <h3>Add Event</h3>
                                        <form method="POST" action="{{ route('admin.exemple.store') }}" onsubmit="return addEvent();">
                                            @csrf
                                            <input name="eventDate" type="date" id="eventDate" required>
                                            <input name="eventTitle" type="text" id="eventTitle" placeholder="Event Title" required>
                                            <input name="eventDescription" type="text" id="eventDescription" placeholder="Event Description" required>
                                            <button type="submit" id="addEvent">Add</button>
                                        </form>
                                    </div>
                                    <div id="reminder-section">
                                        <h3>Reminders</h3>
                                        <ul id="reminderList">
                                            @foreach ($exemples as $exemple)
                                                <li data-event-id="{{ $exemple->id }}">
                                                    <strong>{{ $exemple->eventTitle }}</strong> - 
                                                    {{ $exemple->eventDescription }} on 
                                                    {{ \Carbon\Carbon::parse($exemple->eventDate)->format('d-m-Y') }}
                                                    <button class="delete-event" onclick="deleteEvent({{ $exemple->id }})">
                                                        Supprimer
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>                                         
                                    </div>                                                                                                                
                                </div>                                    
                                <div id="right">
                                    <h3 id="monthAndYear"></h3>
                                    <div class="button-container-calendar">
                                        <button id="previous" onclick="previous()">‹</button>
                                        <button id="next" onclick="next()">›</button>
                                    </div>
                                    <table class="table-calendar" id="calendar" data-lang="en">
                                        <thead id="thead-month"></thead>
                                        <tbody id="calendar-body"></tbody>
                                    </table>
                                    <div class="footer-container-calendar">
                                        <label for="month">Aller à: </label>
                                        <select id="month" onchange="jump()">
                                            <option value=0>Janvier</option>
                                            <option value=1>Février</option>
                                            <option value=2>Mars</option>
                                            <option value=3>Avril</option>
                                            <option value=4>Mai</option>
                                            <option value=5>Juin</option>
                                            <option value=6>Juillet</option>
                                            <option value=7>Août</option>
                                            <option value=8>Septembre</option>
                                            <option value=9>Octobre</option>
                                            <option value=10>Novembre</option>
                                            <option value=11>Décembre</option>
                                        </select>
                                        <select id="year" onchange="jump()"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
                
            </div>

        </main>
    </section>

@endsection


<script>
    // script.js

    // Define an array to store events
    let events = [];

    // Variables to store event input fields and reminder list
    let eventDateInput = document.getElementById("eventDate");
    let eventTitleInput = document.getElementById("eventTitle");
    let eventDescriptionInput = document.getElementById("eventDescription");
    let reminderList = document.getElementById("reminderList");

    // Function to add events
    function addEvent() {
        let date = eventDateInput.value;
        let title = eventTitleInput.value;
        let description = eventDescriptionInput.value;

        if (date && title) {
            // Create a unique event ID
            let eventId = events.length + 1; // Adjusted to keep unique IDs

            // Push new event into events array
            events.push({
                id: eventId, 
                date: date,
                title: title,
                description: description
            });

            // Clear the input fields
            eventDateInput.value = "";
            eventTitleInput.value = "";
            eventDescriptionInput.value = "";
            
            // Display reminders after adding a new event
            displayReminders();
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }

    // Function to delete an event by ID
    function deleteEvent(eventId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')) {
            // Delete from the array
            events = events.filter(event => event.id !== eventId);

            // Remove the event from the UI
            document.querySelector(`li[data-event-id="${eventId}"]`).remove();
            alert('Événement supprimé avec succès.');
        }
    }

    // Function to display reminders
    function displayReminders() {
        reminderList.innerHTML = "";
        for (let event of events) {
            let listItem = document.createElement("li");
            listItem.setAttribute("data-event-id", event.id);
            listItem.innerHTML = `
                <strong>${event.title}</strong> - 
                ${event.description} on 
                ${new Date(event.date).toLocaleDateString()}`;

            // Add a delete button for each reminder item
            let deleteButton = document.createElement("button");
            deleteButton.className = "delete-event";
            deleteButton.textContent = "Supprimer";
            deleteButton.onclick = function () {
                deleteEvent(event.id);
            };

            listItem.appendChild(deleteButton);
            reminderList.appendChild(listItem);
        }
    }

    // Initial call to display reminders based on the current events
    displayReminders();
</script>
