@extends('layouts.app')

@section('content')

                    <div class="ui container">
                        <div class="ui two column stackable grid">
                            <div class="ui three wide column">
                            </div>
                            <div class="ui twelve-wide column">
                                Import set from TopDeck
                                <div class="ui card">
                                    <div class="content">
                                        <button id="importTopdeck" type="submit" class="ui grey button">Import TopDeck</button>

                                    </div>

                                </div>

                                <form id="getProductForm" method="get" class="ui  form">
                                    <div class="field">
                                        <label for="search">Select a card</label>
                                        <input id="card" name="cards" placeholder="Search for a card"/>
                                    </div>
                                    <button type="submit" class="ui button">Search</button>
                                </form>

                                <table id="result"></table>
                            </div>
                        </div>
                    </div>

@endsection
