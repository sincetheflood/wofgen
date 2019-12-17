## Wings of Fire Character Generator
A [Wings of Fire chraacter generator](https://wofocgen.herokuapp.com/) written in PHP. Based off of the [wofocgen](https://perchance.org/wofocgen-testversion) page on [perchance.org](https://perchance.org/).

I've been looking to get into PHP for some time now, and this seemed like a good starter project.

Benefits of the re-write:

-   Loads almost instantaneously. Under a simulated 3G connection my rewrite loads in less than half a second*, the perchance generator takes ~2 seconds to load just the text and ~9 seconds to completely finish.
-   Tribe specific options. For example, only IceWings will live in the Ice Palace, and only LeafWings will live in the Poison Jungle. Dragons from Pantala will not be living in Pyrrhia, and vice versa.

*: When not in use the site will "fall asleep", increasing the first load time. Once awake the site should load within the given timespan.

### License
All PHP code is under the ISC License.