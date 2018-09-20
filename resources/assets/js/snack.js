/*
eslint

no-param-reassign: 0,
*/

class Snack {
  constructor(el) {
    this.container = document.createElement('div');
    this.el = el;

    this.containerStyles = {
      position: 'fixed',
      bottom: '1rem',
      right: '1rem',
    };

    this.hideStyles = {
      opacity: '0',
    };

    this.showStyles = {
      opacity: '1',
    };
  }

  async run(el = this.el) {
    document.body.append(this.container);
    Object.assign(this.container.style, this.containerStyles);

    if (el.length) {
      [...el].map(async (snack, key) => {
        this.container.append(snack);

        Object.assign(snack.style, {
          padding: '8px 12px',
          background: '#000',
          color: 'white',
          opacity: '0',
          transition: 'opacity 700ms ease-in-out',
        });
        
        await this.show(500, snack, {
          marginBottom: '1rem',
          transitionDelay: `${key * -100}ms`,
        });
        await this.hide(3000, snack);
      });
    } else {
      this.container.append(el);

      await this.show(500, null);
      await this.hide(3000, null);
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
