/*
eslint

no-extend-native: 0,
func-names: 0,
*/

String.prototype.ucFirst = function () {
  return this.charAt(0).toUpperCase() + this.slice(1);
};
