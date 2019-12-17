## Wings of Fire Character Generator
A [Wings of Fire chraacter generator](https://wofocgen.herokuapp.com/) written in PHP. Based off of the [wofocgen](https://perchance.org/wofocgen-testversion) page on [perchance.org](https://perchance.org/). I found the original to be a cool idea (Akin to [Chaotic Shiny](http://chaoticshiny.com/), which I love), but severely lacking in logic.
In my personal opinion, a HiveWing should not only be unable to be a General in the SeaWing's Summer Palace, they also shouldn't be able to be a wanted criminal at the same time. Thus I decided to rewrite it.

I've been looking to get into PHP for some time now, and this seemed like a good starter project.

Benefits of the re-write:

-   Loads almost instantaneously. Under a simulated 3G connection my rewrite loads in less than half a second*, the perchance generator takes ~2 seconds to load just the text and ~9 seconds to completely finish.
-   More realistic options. For example, only IceWings will live in the Ice Palace, and only LeafWings will live in the Poison Jungle. Dragons from Pyrrhia will not be living in Pantala (and vice versa). Unless they're hybrids, Pantalan dragons will not be able to possess animus powers.

*: When not in use the site will "fall asleep", increasing the first load time. Once awake the site should load within the given timespan.

### License
All files except those that are in the `web/resources/` directory are under the ISC License. Files in the `web/resources/` directory are in the public domain.