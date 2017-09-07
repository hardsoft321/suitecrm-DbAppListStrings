/**
 * Cyr2lat translit
 * @ artbels
 * artbels@gmail.com
 * 2016
 * ver 1.0.0
 *
 * https://github.com/artbels/cyr2lat-translit
 */

var cyr2lat;
;(function () {
  var Translit = this.Translit = function (input) {

    if(!input) return

    if(typeof input === 'number') input = input.toString()

    if(typeof input !== 'string') return 

    var letterMap = {
      '/': '_',
      '\\': '_',
      "'": '',
      'а': 'a',
      'б': 'b',
      'в': 'v',
      'г': 'g',
      'д': 'd',
      'е': 'e',
      'ж': 'zh',
      'з': 'z',
      'и': 'i',
      'й': 'y',
      'к': 'k',
      'л': 'l',
      'м': 'm',
      'н': 'n',
      'о': 'o',
      'п': 'p',
      'р': 'r',
      'с': 's',
      'т': 't',
      'у': 'u',
      'ф': 'f',
      'х': 'kh',
      'ц': 'ts',
      'ч': 'ch',
      'ш': 'sh',
      'щ': 'sch',
      'ы': 'i',
      'ь': '',
      'ъ': '',
      'э': 'e',
      'ю': 'yu',
      'я': 'ya',
      'ё': 'e',
      'є': 'e',
      'і': 'i',
      'ї': 'yi',
      'ґ': 'g',
      // '+': '-plus'
      '+': '_plus'
    }

    //var reOtherSymbols = /[^a-z0-9\-_]/gi
    var reOtherSymbols = /[^a-z0-9_]/gi

    var replLetters = input.split('').map(function (char) {
      char = char.toLowerCase()
      return (letterMap[char] !== undefined) ? letterMap[char] : char
    }).join('')

    // var replSymb = replLetters.replace(reOtherSymbols, '-')
    var replSymb = replLetters.replace(reOtherSymbols, '_')

    var replUnnecDelims = removeUnnecessaryDelims(replSymb)

    return replUnnecDelims

    function removeUnnecessaryDelims (input) {
      return input
        // .replace(/\-{2,}/g, '-')
        .replace(/\-{2,}/g, '_')
        .replace(/_{2,}/g, '_')
        .replace(/[\-\_]+$/g, '')
        .replace(/^[\-\_]+/g, '')
    }
  }

  if (typeof module !== 'undefined' && module.exports) {
    module.exports = Translit
  }
  cyr2lat = Translit; //pea
})()
