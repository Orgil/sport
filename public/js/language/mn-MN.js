// If you want to suggest a new language you can use this file as a template.
// To reduce the file size you should remove the comment lines (the ones that start with // )
if(!window.calendar_languages) {
	window.calendar_languages = {};
}
// Here you define the language and Country code. Replace en-US with your own.
// First letters: the language code (lower case). See http://www.loc.gov/standards/iso639-2/php/code_list.php
// Last letters: the Country code (upper case). See http://www.iso.org/iso/home/standards/country_codes/country_names_and_code_elements.htm
window.calendar_languages['mn-MN'] = {
	error_noview: 'Calendar: View {0} not found',
	error_dateformat: 'Calendar: Wrong date format {0}. Should be either "now" or "yyyy-mm-dd"',
	error_loadurl: 'Calendar: Event URL is not set',
	error_where: 'Calendar: Wrong navigation direction {0}. Can be only "next" or "prev" or "today"',

	no_events_in_day: 'No events in this day.',

	// {0} will be replaced with the year (example: 2013)
	title_year: '{0} он',
	// {0} will be replaced with the month name (example: September)
	// {1} will be replaced with the year (example: 2013)
	title_month: '{1} оны {0}',
	// {0} will be replaced with the week number (example: 37)
	// {1} will be replaced with the year (example: 2013)
	title_week: '{1} оны {0}-р долоо хоног',
	// {0} will be replaced with the weekday name (example: Thursday)
	// {1} will be replaced with the day of the month (example: 12)
	// {2} will be replaced with the month name (example: September)
	// {3} will be replaced with the year (example: 2013)
	title_day: '{0} {1} {2}, {3}',

	week:'7 хоног',

	m0: '1 сар',
	m1: '2 сар',
	m2: '3 сар',
	m3: '4 сар',
	m4: '5 сар',
	m5: '6 сар',
	m6: '7 сар',
	m7: '8 сар',
	m8: '9 сар',
	m9: '10 сар',
	m10: '11 сар',
	m11: '12 сар',

	ms0: '1 сар',
	ms1: '2 сар',
	ms2: '3 сар',
	ms3: '4 сар',
	ms4: '5 сар',
	ms5: '6 сар',
	ms6: '7 сар',
	ms7: '8 сар',
	ms8: '9 сар',
	ms9: '10 сар',
	ms10: '11 сар',
	ms11: '12 сар',

	d0: 'Ням',
	d1: 'Даваа',
	d2: 'Мягмар',
	d3: 'Лхагва',
	d4: 'Пүрэв',
	d5: 'Баасан',
	d6: 'Бямба',

	// Which is the first day of the week (2 for sunday, 1 for monday)
	first_day: 1,

	// The list of the holidays.
	// Each holiday has a date definition and a name (in your language)
	// For instance:
	// holidays: {
	// 	'date': 'name',
	// 	'date': 'name',
	// 	...
	//   'date': 'name' //No ending comma for the last holiday
	// }
	// The format of the date may be one of the following:
	// # For a holiday recurring every year in the same day: 'dd-mm' (dd is the day of the month, mm is the month). For example: '25-12'.
	// # For a holiday that exists only in one specific year: 'dd-mm-yyyy' (dd is the day of the month, mm is the month, yyyy is the year). For example: '31-01-2013'
	// # For Easter: use simply 'easter'
	// # For holidays that are based on the Easter date: 'easter+offset in days'.
	//   Some examples:
	//   - 'easter-2' is Good Friday (2 days before Easter)
	//   - 'easter+1' is Easter Monday (1 day after Easter)
	//   - 'easter+39' is the Ascension Day
	//   - 'easter+49' is Pentecost
	// # For holidays that are on a specific weekday after the beginning of a month: 'mm+n*w', where 'mm' is the month, 'n' is the ordinal position, 'w' is the weekday being 0: Sunday, 1: Monday, ..., 6: Saturnday
	//   For example:
	//   - Second (2) Monday (1) in October (10): '10+2*1'
	// # For holidays that are on a specific weekday before the ending of a month: 'mm-n*w', where 'mm' is the month, 'n' is the ordinal position, 'w' is the weekday being 0: Sunday, 1: Monday, ..., 6: Saturnday
	//   For example:
	//   - Last (1) Saturnday (6) in Match (03): '03-1*6'
	//   - Last (1) Monday (1) in May (05): '05-1*1'
	// # You can also specify a holiday that lasts more than one day. To do that use the format 'start>end' where 'start' and 'end' are specified as above.
	//   For example:
	//   - From 1 January to 6 January: '01-01>06-01'
	//   - Easter and the day after Easter: 'easter>easter+1'
	//   Limitations: currently the multi-day holydays can't cross an year. So, for example, you can't specify a range as '30-12>01-01'; as a workaround you can specify two distinct holidays (for instance '30-12>31-12' and '01-01').
	holidays: {
	}
};
