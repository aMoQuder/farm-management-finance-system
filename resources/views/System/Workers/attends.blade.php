<!-- resources/views/workers/edit.blade.php -->
@extends('layouts.dashboard')

@section('content')
    @if (session('success'))
        <h4 class="alert alert-success text-center">{{ session('success') }}</h4>
    @endif
            <div class="calendar-container">
                <div class="calendar-header">
                    <div class="calendar-title" id="calendarTitle"></div>

                    <div class="calendar-controls">
                        <button id="todayBtn">Today</button>
                        <button id="prevWeek">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M15 18l-6-6 6-6" />
                            </svg>
                        </button>
                        <button id="nextWeek">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M9 6l6 6-6 6" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="calendar-scroll">
                    <table class="calendar-table">
                        <thead>
                            <tr id="daysRow"></tr>
                        </thead>
                        <tbody>
                            <tr id="datesRow"></tr>
                            <tr id="workersRow"></tr>
                        </tbody>
                    </table>
                </div>
            </div>




    
@endsection
