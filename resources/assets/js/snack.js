/*
eslint

no-param-reassign: 0,
*/

class Snack {
  constructor(el) {
    this.container = document.createElement('div');
    this.el = el;

    this.hideTimeout = 5000;
    this.showTimeout = 500;
    this.staggerDelay = 100;

    this.hideStyles = {
      opacity: '0',
    };

    this.showStyles = {
      opacity: '1',
    };
  }

  async run(el = this.el) {
    this.container.classList.add('snack__container');
    document.body.append(this.container);

    Object.assign(this.container.style, this.containerStyles);

    if (el.length) {
      [...el].map(async (snack, key) => {
        this.container.append(snack);

        await this.show(this.showTimeout, snack, {
          marginBottom: key === 0 ? '0' : '1rem',
          transitionDelay: `${key * -this.staggerDelay}ms`,
        });
        await this.hide(this.hideTimeout, snack);
      });
    }
  }

  hide(timeout = 0, el = this.el, styles = {}) {
    return new Promise((resolve) => {
      setTimeout(() => {
        Object.assign(el.style, {
          ...this.hideStyles,
          ...styles,
        });

        resolve();
      }, timeout);
    });
  }

  show(timeout = 0, el = this.el, styles = {}) {
    return new Promise((resolve) => {
      setTimeout(() => {
        Object.assign(el.style, {
          ...this.showStyles,
          ...styles,
        });

        resolve();
      }, timeout);
    });
  }
}

const snacks = document.querySelectorAll('.snack');
new Snack(snacks).run();

export default Snack;
