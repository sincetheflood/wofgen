## Wings of Fire Character Generator
A Wings of Fire chraacter generator written in PHP. Based off of the [wofocgen](https://perchance.org/wofocgen-testversion) page on [perchance.org](https://perchance.org/).

### Why re-create it?
I've been looking to get into PHP for some time now, and this seemed like a good starter project.

Benefits of the re-write:
- Loads almost instantaneously. Under a simulated 3G connection my rewrite loads in less than half a second*, the perchance generator takes ~2 seconds to load just the text and ~9 seconds to completely finish.
- Tribe specific options. For example, only IceWings will live in the Ice Palace, and only LeafWings will live in the Poison Jungle.

### License
All PHP code is under the ISC License.

*: When not in use the site will "fall asleep", increasing the first load time. Once awake the 