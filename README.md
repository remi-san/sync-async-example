Make Sync Code Async
===

How to switch from a synchronous implementation to an asynchronous implementation:

- Start by a sync implementation (see `bin/sync.php`).
- Select the best component to make async (see `bin/async-publish.php` and `bin/async-consume.php`)

    - The implementation of the `listener` is changed to publish in the chosen exchange.
    - You keep the same instruction `$emitter->emit(new Event(MY_EVENT));`
    
    - The consumer part gets to have the original `listener`
    - A new `emitter` is declared to be able to use the `listener` correctly
