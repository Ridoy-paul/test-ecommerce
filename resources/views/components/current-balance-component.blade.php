<div class="text-center py-3">
    <h2>Current Balance</h2>
    <h1><b>TK {{ number_format(optional(Auth::user())->balance, 2) }}</b></h1>
</div>