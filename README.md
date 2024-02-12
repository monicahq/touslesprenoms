<p align="center">

![Touslesprenoms's Logo](https://github.com/djaiss/bivouac/assets/61099/d47cc206-6306-4711-8050-2417a4c17dd2)

</p>

## Touslesprenoms is an open source name database.

It contains:

- a complete database of more than 39 000 first names used in France,
- a way to share lists of names with your friends.

### License

MIT license.

### How to import the INSEE database

- first, * replace all semi colons with commas in the CSV provided by the INSEE
  * `sed 's/;/,/g' yourfile.csv > newfile.csv`
- next, run the command `php artisan touslesprenoms:import`
- finally, run the command `php artisan touslesprenoms:count-total-after-import`

### Cache

There is a lot of cache instances in this project. Everything is cached. If you encounter any problem while debugging, remember to clear the cache with `php artisan cache:clear`.
