function FormatCurrency(objNum){	
	var num = objNum.value
	if(num==undefined)
		var num = objNum.val();
	var ent, dec;

	if (num != '' && num != objNum.oldvalue)
	{
		num = MoneyToNumber(num);
		if (isNaN(num))
		{		
			objNum.value = (objNum.oldvalue)?objNum.oldvalue:'';
		} else {
			var ev = (navigator.appName.indexOf('Netscape') != -1)?Event:event;
	
			if (ev.keyCode == 190 || !isNaN(num.split('.')[1]))
			{	
				objNum.value = AddCommas(num.split('.')[0])+'.'+num.split('.')[1];
			}
			else
			{	
				objNum.value = AddCommas(num.split('.')[0]);
			}
	
			objNum.oldvalue = objNum.value;
		}
	}
}

function numberWithCommas(num) {
    var parts = num.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

function MoneyToNumber(num){
	if(num != '' && num != null)
	{
		// return num.split(',').join('');
		return num.toString().replace(/,/g, '');
	}
	else
	{
		return parseInt(0);
	}
}

function AddCommas(num){
	numArr=new String(num).split('').reverse();
	for (i=3;i<numArr.length;i+=3)
	{
		numArr[i]+=',';
	}
	return numArr.reverse().join('');
}

function NumberToMoney(num){
	numberArr = new String(num).split(',');
	numArr=new String(numberArr[0]).split('').reverse();
	for (i=3;i<numArr.length;i+=3)
	{
		numArr[i]+=',';
	}
	numberArr[0] = numArr.reverse().join('');
	if (numberArr[1] == null || numberArr[1] == '') numberArr[1] = '00';
	return numberArr[0] + "." + numberArr[1];
}

function NumbToMonDot(num){
    numberArr = new String(num).split('.');
    numArr=new String(numberArr[0]).split('').reverse();
    for (i=3;i<numArr.length;i+=3)
    {
        numArr[i]+=',';
    }
    numberArr[0] = numArr.reverse().join('');
    if (numberArr[1] == null || numberArr[1] == '') numberArr[1] = '00';
    return numberArr[0] + "." + numberArr[1];
}

function NumbToMon(num){
    numberArr = new String(num).split('.');
    numArr=new String(numberArr[0]).split('').reverse();
    for (i=3;i<numArr.length;i+=3)
    {
        numArr[i]+='.';
    }
    numberArr[0] = numArr.reverse().join('');
    if (numberArr[1] == null || numberArr[1] == '') numberArr[1] = '00';
    return numberArr[0] + "," + numberArr[1];
}

function only_number(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        return true;
}

function isPositive(number){
    if(number < 0){
        number = Math.abs(number);
        number = "(Rp. "+NumberToMoney(number)+")";
    }else{
        number = "Rp. "+NumberToMoney(number);
    }
    return number;
}