s=String;
s.prototype.r = s.prototype.replace;
function calcPoint(input) {
    var j = input % 8,
        input = (input / 8)|0 % 4,
        cardinal = ['north', 'east', 'south', 'west'],
        pointDesc = ['1', '1 by 2', '1-C', 'C by 1', 'C', 'C by 2', '2-C', '2 by 1'],
        str1, str2, strC;

    str1 = cardinal[input];
    str2 = cardinal[(input + 1) % 4];
    strC = (str1 == cardinal[0] | str1 == cardinal[2]) ? str1 + str2 : str2 + str1;
    return pointDesc[j].r(1, str1).r(2, str2).r('C', strC);
}
function getShortName(name) {
    return name.r(/north/g, "N").r(/east/g, "E").r(/south/g, "S").r(/west/g, "W").r(/by/g, "b").r(/[\s-]/g, "");
}

// var input = prompt() / 11.25;
// input = input+.5|0;
// var name = calcPoint(input);
// var shortName = getShortName(name);
// name = name[0].toUpperCase() + name.slice(1);
// alert(name + " " + shortName);