package aoc2025

import (
	"strings"
	"testing"

	"github.com/stretchr/testify/require"

	"aoc/utils"
)

const day05 = "2025_05"

func TestDay05Part1(t *testing.T) {
	input := utils.ReadFileIntoString(day05, "test")
	require.Equal(t, 3, Day05Part1(input))
}

func TestDay05Part1Input(t *testing.T) {
	input := utils.ReadFileIntoString(day05, "input")
	require.Equal(t, 694, Day05Part1(input))
}

func TestDay05Part2(t *testing.T) {
	input := utils.ReadFileIntoString(day05, "test")
	require.Equal(t, 14, Day05Part2(input))
}

// 418533859502745 You don't seem to be solving the right level. Did you already complete it?
// 401384835049422 is too high
// 376256455947831 is too high
// 376116650289447 is too high
// 315247014814646 is incorrect
// 342740332676198 is incorrect
// 360245795341068 is incorrect
// 352716206375547 is the next guess
func TestDay05Part2Input(t *testing.T) {
	input := utils.ReadFileIntoString(day05, "input")
	require.Equal(t, 352716206375547, Day05Part2(input))
}

func Test_consolidateRanges(t *testing.T) {
	tests := []struct {
		name     string
		input    []FreshRange
		expected []FreshRange
	}{
		{
			"sample1",
			[]FreshRange{{3, 5}, {10, 14}, {16, 20}, {12, 18}},
			[]FreshRange{{3, 5}, {10, 20}},
		},
		{
			"sample1",
			[]FreshRange{{318321327621, 2000604286918}, {1276540942943, 3152355546365}},
			[]FreshRange{{318321327621, 3152355546365}},
		},
		{
			name:     "single with same single",
			input:    []FreshRange{{1, 1}, {1, 1}},
			expected: []FreshRange{{1, 1}},
		},
		{
			name:     "single that matches start of following range",
			input:    []FreshRange{{1, 1}, {1, 2}},
			expected: []FreshRange{{1, 2}},
		},
		{
			name:     "single with different single",
			input:    []FreshRange{{1, 1}, {2, 2}},
			expected: []FreshRange{{1, 1}, {2, 2}},
		},
		{
			name:     "single with separate range next",
			input:    []FreshRange{{1, 1}, {2, 3}},
			expected: []FreshRange{{1, 1}, {2, 3}},
		},
		{
			name:     "range with identical range ",
			input:    []FreshRange{{1, 2}, {1, 2}},
			expected: []FreshRange{{1, 2}},
		},
		{
			name:     "range with range with same start",
			input:    []FreshRange{{1, 2}, {1, 3}},
			expected: []FreshRange{{1, 3}},
		},
		{
			name:     "range with single that matches end",
			input:    []FreshRange{{1, 2}, {2, 2}},
			expected: []FreshRange{{1, 2}},
		},
		{
			name:     "ranges with an overlapping start and end",
			input:    []FreshRange{{1, 2}, {2, 3}},
			expected: []FreshRange{{1, 3}},
		},
		{
			name:     "range with single outside range",
			input:    []FreshRange{{1, 2}, {3, 3}},
			expected: []FreshRange{{1, 2}, {3, 3}},
		},
		{
			name:     "ranges with no overlap",
			input:    []FreshRange{{1, 2}, {3, 4}},
			expected: []FreshRange{{1, 2}, {3, 4}},
		},
		{
			name:     "ranges with same end",
			input:    []FreshRange{{1, 3}, {2, 3}},
			expected: []FreshRange{{1, 3}},
		},
		{
			name:     "staggered ranges",
			input:    []FreshRange{{1, 3}, {2, 4}},
			expected: []FreshRange{{1, 4}},
		},
		{
			name:     "single with range it fits inside",
			input:    []FreshRange{{2, 2}, {1, 3}},
			expected: []FreshRange{{1, 3}},
		},
		{
			name:     "inner range then outer range",
			input:    []FreshRange{{2, 3}, {1, 4}},
			expected: []FreshRange{{1, 4}},
		},
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			require.Equal(t, tt.expected, consolidateRanges(tt.input))
		})
	}
}

func Test_consolidateRangesFromInput(t *testing.T) {
	input := utils.ReadFileIntoString(day05, "input")
	freshRanges := getFreshRanges(strings.Split(strings.Split(input, "\n\n")[0], "\n"))
	expected := []FreshRange{
		{318321327621, 9560062807547},
		{10824367215596, 14301852706079},
		{14301852706080, 18176512869247},
		{20193919567674, 23582521260712},
		{24009226723279, 24946077819020},
		{25274755547260, 25793124052420},
		{27254073368602, 27863819835707},
		{28319450338985, 29828083138406},
		{34397813664404, 34397813664404},
		{34397813664405, 35889724998976},
		{42344652917767, 44328029879699},
		{44328029879701, 48123041770234},
		{52998694266417, 58893501672397},
		{61032320290364, 68562867264572},
		{71812554505230, 79680692210816},
		{82681114767183, 89072760947026},
		{94143750134639, 98586182238539},
		{98586182238540, 98586182238540},
		{104747179050467, 109097267131461},
		{112250917862250, 116296825072047},
		{121546599592513, 129862100665806},
		{133426317041501, 139764524734549},
		{143708019265221, 146257973155899},
		{146257973155900, 149106704589549},
		{151192496061656, 156915268255395},
		{156915268255397, 158042605202224},
		{164152387656407, 167704337374200},
		{171642957024437, 180142486031845},
		{184940436448192, 189902212010148},
		{191195578167684, 200939977745849},
		{203196395280918, 208521390563907},
		{208521390563908, 208521390563908},
		{212713992782222, 219650448157128},
		{223082273803282, 230371132621458},
		{232391725301276, 238713510398280},
		{241384227973286, 241827411277043},
		{242697102308023, 242848386712690},
		{243310423787558, 243651445496298},
		{244991861174243, 245734854092672},
		{245899464235291, 246389816279678},
		{247517902751889, 248255248970966},
		{248398856491167, 251021195550869},
		{255015395258899, 259622120267858},
		{263627281467737, 267533243616466},
		{274441318741349, 274441318741349},
		{274441318741350, 278455061523695},
		{283128359794483, 290169400007104},
		{292523902046334, 299981619411875},
		{302243631309925, 310380171638436},
		{312639462899835, 318676175799901},
		{318676175799902, 318676175799902},
		{322258474897056, 331458014690461},
		{332113337516743, 333406396627542},
		{334436916398543, 335172863592753},
		{335870703252328, 338595239953940},
		{340192926856970, 341084959437207},
		{343485227120057, 351026704707496},
		{354558318115320, 354558318115320},
		{354558318115321, 358152381942091},
		{363006070170847, 371004683769245},
		{374667004122140, 380747645639964},
		{384738421053458, 387876908075215},
		{392720969540406, 398150352950082},
		{398150352950083, 399419751402066},
		{403203599110022, 407379888162766},
		{407379888162768, 410316986824905},
		{413838136628098, 420668460362907},
		{423047035138711, 430259278073619},
		{430259278073620, 430259278073620},
		{433402266950738, 440387581916694},
		{443781930697663, 450867195965087},
		{452752960613735, 453687082501022},
		{455104473155394, 455606892130714},
		{455981197702225, 456481281085662},
		{456738993958004, 457237068938802},
		{457434951078358, 459339447370032},
		{459560468170564, 459990950376756},
		{460629822509596, 461336936899782},
		{461501482647802, 461731829021950},
		{463970787392803, 466340815053320},
		{466340815053322, 471815065184282},
		{472959134292726, 482096737195811},
		{485427730042231, 491324341674635},
		{493527145986804, 501579729600175},
		{506436163444054, 508694499717838},
		{514488918319381, 517242404413660},
		{517242404413661, 522375391736113},
		{523764387915260, 530683739440807},
		{535016673969078, 539340010469370},
		{544988139928091, 551929359499591},
		{557257867290147, 557257867290147},
		{557257867290148, 562274260919735},
	}
	require.Equal(t, expected, consolidateRanges(freshRanges))
}
